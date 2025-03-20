import * as d3 from "d3";

// Data models
interface ProductData {
    name: string;
    sales: number;
    color: string;
    id: string | number;
}

interface UserSpendingData {
    userId: string | number;
    userName: string;
    totalSpent: number;
    avgOrderPrice: number;
    highestOrderPrice: number;
    lowestOrderPrice: number;
    orderCount: number;
    color: string;
}

const colorPalette = [
    "#4C72B0", "#55A868", "#C44E52", "#8172B3", "#CCB974", "#64B5CD",
    "#377EB8", "#FF7F00", "#4DAF4A", "#984EA3", "#F781BF", "#A65628"
];

let bestSellingData: ProductData[] = [];
let worstSellingData: ProductData[] = [];
let topSpendingUsersData: UserSpendingData[] = [];

async function queryData(endpoint: string, limit = 10): Promise<ProductData[] | UserSpendingData[]> {
    try {
        const response = await fetch(`/admin/stats/${endpoint}?limit=${limit}`);
        if (!response.ok) throw new Error('Network response was not ok');

        const { data } = await response.json();
        if (!data || !Array.isArray(data)) throw new Error('Unexpected data format');

        return endpoint === 'top-spending-users'
            ? data.map((user, i) => ({
                userId: user.id,
                userName: user.name || `User ${user.id}`,
                totalSpent: user.total_spent || 0,
                avgOrderPrice: user.average_order_price || 0,
                highestOrderPrice: user.highest_order_price || 0,
                lowestOrderPrice: user.lowest_order_price || 0,
                orderCount: user.order_count || 0,
                color: colorPalette[i % colorPalette.length]
            }))
            : data.map((product, i) => ({
                name: product.name,
                sales: product.total_sold ?? 0,
                color: colorPalette[i % colorPalette.length],
                id: product.id
            }));
    } catch (error) {
        console.error(`Error fetching ${endpoint} data:`, error);
        return [];
    }
}

function createBarChart(data: ProductData[], containerId: string, legendId: string): void {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = '';
    container.style.overflow = 'visible';

    const width = container.clientWidth;
    const height = container.clientHeight || 400;

    const margin = {
        top: Math.max(30, height * 0.08),
        right: Math.max(30, width * 0.05),
        bottom: Math.max(100, height * 0.25),
        left: Math.max(50, width * 0.1)
    };

    const chartWidth = width - margin.left - margin.right;
    const chartHeight = height - margin.top - margin.bottom;

    const svg = d3.select(`#${containerId}`)
        .append('svg')
        .attr('width', width)
        .attr('height', height)
        .attr('viewBox', `0 0 ${width} ${height}`)
        .style('overflow', 'visible')
        .append('g')
        .attr('transform', `translate(${margin.left},${margin.top})`);

    const x = d3.scaleBand()
        .domain(data.map(d => d.name))
        .range([0, chartWidth])
        .padding(0.2);

    const y = d3.scaleLinear()
        .domain([0, d3.max(data, d => d.sales) ?? 0])
        .nice()
        .range([chartHeight, 0]);

    // X-axis with angled labels
    const xAxis = svg.append('g')
        .attr('transform', `translate(0,${chartHeight})`)
        .call(d3.axisBottom(x));

    xAxis.selectAll('text')
        .style('text-anchor', 'end')
        .style('font-size', '11px')
        .attr('transform', `translate(-10,10)rotate(${data.length > 8 ? -45 : -30})`)
        .style('overflow', 'visible');

    svg.append('g')
        .call(d3.axisLeft(y))
        .selectAll('text')
        .style('font-size', '11px');

    svg.append('text')
        .attr('transform', 'rotate(-90)')
        .attr('y', -margin.left + 20)
        .attr('x', -chartHeight / 2)
        .attr('text-anchor', 'middle')
        .text('Sales')
        .style('font-size', '14px');

    // Bars with interactive features
    svg.selectAll('.bar-group')
        .data(data)
        .enter()
        .append('a')
        .attr('href', d => `/product/${d.id}`)
        .attr('class', 'bar-link')
        .append('rect')
        .attr('class', 'bar')
        .attr('x', d => x(d.name) ?? 0)
        .attr('y', d => y(d.sales))
        .attr('width', x.bandwidth())
        .attr('height', d => chartHeight - y(d.sales))
        .attr('fill', d => d.color)
        .style('opacity', 0.8)
        .style('cursor', 'pointer')
        .on('mouseover', function (event: MouseEvent, d: ProductData) {
            d3.select(this)
                .style('opacity', 1)
                .attr('stroke', '#333')
                .attr('stroke-width', 2);

            svg.append('g')
                .attr('class', 'tooltip')
                .attr('transform', `translate(${x(d.name) ?? 0 + x.bandwidth() / 2},${y(d.sales) - 10})`)
                .append('text')
                .attr('text-anchor', 'middle')
                .style('font-size', '14px')
                .style('font-weight', 'bold')
                .text(`${d.sales}`);
        })
        .on('mouseout', function () {
            d3.select(this)
                .style('opacity', 0.8)
                .attr('stroke', 'none');
            svg.select('.tooltip').remove();
        });

    updateLegend(data, legendId);
}

function createPieChart(data: ProductData[], containerId: string, legendId: string): void {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = '';
    container.style.overflow = 'visible';

    const width = container.clientWidth;
    const height = container.clientHeight || 400;
    const radius = Math.min(width, height) / 2;

    // Create SVG
    const svg = d3.select(`#${containerId}`)
        .append('svg')
        .attr('width', width)
        .attr('height', height)
        .attr('viewBox', `0 0 ${width} ${height}`)
        .append('g')
        .attr('transform', `translate(${width / 2},${height / 2})`);

    // Create pie generator
    const pie = d3.pie<ProductData>()
        .value(d => d.sales)
        .sort(null);

    // Create arc generator
    const arc = d3.arc<d3.PieArcDatum<ProductData>>()
        .innerRadius(50)
        .outerRadius(radius * 0.8);

    // Create outer arc for labels
    const outerArc = d3.arc<d3.PieArcDatum<ProductData>>()
        .innerRadius(radius * 0.9)
        .outerRadius(radius * 0.9);

    // Create pie slices
    const slices = svg.selectAll('.arc')
        .data(pie(data))
        .enter()
        .append('g')
        .attr('class', 'arc');

    // Add paths (the actual pie slices)
    slices.append('path')
        .attr('d', arc)
        .attr('fill', d => d.data.color)
        .style('opacity', 0.8)
        .style('stroke', 'white')
        .style('stroke-width', 2)
        .style('cursor', 'pointer')
        .on('mouseover', function(event, d) {
            d3.select(this)
                .style('opacity', 1)
                .attr('stroke', '#333')
                .attr('stroke-width', 3);

            // Add tooltip
            svg.append('text')
                .attr('class', 'tooltip')
                .attr('text-anchor', 'middle')
                .attr('dy', '0.35em')
                .style('font-size', '16px')
                .style('font-weight', 'bold')
                .text(`${d.data.name}: ${d.data.sales}`);
        })
        .on('mouseout', function() {
            d3.select(this)
                .style('opacity', 0.8)
                .attr('stroke', 'white')
                .attr('stroke-width', 2);

            svg.select('.tooltip').remove();
        })
        .on('click', function(event, d) {
            window.location.href = `/product/${d.data.id}`;
        });

    // Add labels with lines connecting to slices
    // slices.append('polyline')
    //     .attr('points', function(d) {
    //         const pos = outerArc.centroid(d);
    //         const midAngle = Math.atan2(pos[1], pos[0]);
    //         const x = Math.cos(midAngle) * radius * 0.95;
    //         const y = Math.sin(midAngle) * radius * 0.95;
    //         return [arc.centroid(d), outerArc.centroid(d), [x, y]];
    //     })
    //     .style('fill', 'none')
    //     .style('stroke', '#999')
    //     .style('stroke-width', 1)
    //     .style('opacity', 0.3);

    // Add the text labels
    // slices.append('text')
    //     .attr('transform', function(d) {
    //         const pos = outerArc.centroid(d);
    //         const midAngle = Math.atan2(pos[1], pos[0]);
    //         const x = Math.cos(midAngle) * radius * 0.98;
    //         const y = Math.sin(midAngle) * radius * 0.98;
    //         return `translate(${x},${y})`;
    //     })
    //     .attr('text-anchor', function(d) {
    //         const pos = outerArc.centroid(d);
    //         return (pos[0] >= 0) ? 'start' : 'end';
    //     })
    //     .text(d => {
    //         // Only show label if it's a significant slice (>5% of total)
    //         const total = d3.sum(data, d => d.sales);
    //         const percentage = (d.data.sales / total) * 100;
    //         if (percentage < 5) return '';
    //
    //         // Abbreviate long names
    //         let name = d.data.name;
    //         if (name.length > 12) {
    //             name = name.substring(0, 10) + '...';
    //         }
    //         return name;
    //     })
    //     .style('font-size', '12px')
    //     .style('font-weight', 'normal')
    //     .style('pointer-events', 'none');

    // Add a title
    // svg.append('text')
    //     .attr('x', 0)
    //     .attr('y', -height / 2 + 20)
    //     .attr('text-anchor', 'middle')
    //     .style('font-size', '16px')
    //     .style('font-weight', 'bold')
    //     .text(' Sales Distribution');

    // Update legend
    updateLegend(data, legendId);
}

function createUserSpendingChart(data: UserSpendingData[], containerId: string, legendId: string): void {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = '';
    container.style.overflow = 'visible';

    const width = container.clientWidth;
    const height = container.clientHeight || 400;

    const margin = {
        top: Math.max(30, height * 0.08),
        right: Math.max(50, width * 0.1),
        bottom: Math.max(100, height * 0.25),
        left: Math.max(70, width * 0.15)
    };

    const chartWidth = width - margin.left - margin.right;
    const chartHeight = height - margin.top - margin.bottom;

    const svg = d3.select(`#${containerId}`)
        .append('svg')
        .attr('width', width)
        .attr('height', height)
        .attr('viewBox', `0 0 ${width} ${height}`)
        .style('overflow', 'visible')
        .append('g')
        .attr('transform', `translate(${margin.left},${margin.top})`);

    const x = d3.scaleBand()
        .domain(data.map(d => d.userName))
        .range([0, chartWidth])
        .padding(0.3);

    const maxPrice = d3.max(data, d => d.highestOrderPrice) ?? 0;

    const y = d3.scaleLinear()
        .domain([0, maxPrice * 1.1])
        .nice()
        .range([chartHeight, 0]);

    // X-axis with angled labels
    const xAxis = svg.append('g')
        .attr('transform', `translate(0,${chartHeight})`)
        .call(d3.axisBottom(x));

    xAxis.selectAll('text')
        .style('text-anchor', 'end')
        .style('font-size', '11px')
        .attr('transform', `translate(-10,10)rotate(${data.length > 5 ? -45 : -30})`)
        .style('overflow', 'visible');

    // Y-axis with currency formatting
    svg.append('g')
        .call(d3.axisLeft(y).tickFormat(d => `£${d3.format(",.2f")(d)}`))
        .selectAll('text')
        .style('font-size', '11px');

    // svg.append('text')
    //     .attr('transform', 'rotate(-90)')
    //     .attr('y', -margin.left + 30)
    //     .attr('x', -chartHeight / 2)
    //     .attr('text-anchor', 'middle')
    //     .text('Order Price (£)')
    //     .style('font-size', '14px');

    // User groups for price range visualization
    const userGroups = svg.selectAll('.user-group')
        .data(data)
        .enter()
        .append('g')
        .attr('class', 'user-group')
        .attr('transform', d => `translate(${(x(d.userName) ?? 0) + x.bandwidth() / 2}, 0)`);

    // Price range line
    userGroups.append('line')
        .attr('class', 'price-range-line')
        .attr('x1', 0)
        .attr('x2', 0)
        .attr('y1', d => y(d.lowestOrderPrice))
        .attr('y2', d => y(d.highestOrderPrice))
        .attr('stroke', d => d.color)
        .attr('stroke-width', 2)
        .style('opacity', 0.7);

    // Average price marker
    userGroups.append('circle')
        .attr('class', 'avg-price-marker')
        .attr('cx', 0)
        .attr('cy', d => y(d.avgOrderPrice))
        .attr('r', 6)
        .attr('fill', d => d.color)
        .attr('stroke', '#333')
        .attr('stroke-width', 1)
        .style('cursor', 'pointer')
        .on('mouseover', function (event: MouseEvent, d: UserSpendingData) {
            d3.select(this)
                .attr('r', 8)
                .attr('stroke-width', 2);

            // Add tooltip for average price and order info
            const tooltip = svg.append('g')
                .attr('class', 'tooltip')
                .attr('transform', `translate(${x(d.userName) ?? 0 + x.bandwidth() / 2},${y(d.avgOrderPrice) - 15})`);

            tooltip.append('text')
                .attr('text-anchor', 'middle')
                .style('font-size', '12px')
                .style('font-weight', 'bold')
                .text(`Avg: £${d3.format(",.2f")(d.avgOrderPrice)}`);

            svg.append('g')
                .attr('class', 'tooltip order-count')
                .attr('transform', `translate(${x(d.userName) ?? 0 + x.bandwidth() / 2},${y(d.avgOrderPrice) - 30})`)
                .append('text')
                .attr('text-anchor', 'middle')
                .style('font-size', '12px')
                .text(`Orders: ${d.orderCount} | Total: £${d3.format(",.2f")(d.totalSpent)}`);
        })
        .on('mouseout', function () {
            d3.select(this)
                .attr('r', 6)
                .attr('stroke-width', 1);
            svg.selectAll('.tooltip').remove();
        });

    // Price markers with tooltips
    userGroups.append('line')
        .attr('class', 'highest-price-marker')
        .attr('x1', -5)
        .attr('x2', 5)
        .attr('y1', d => y(d.highestOrderPrice))
        .attr('y2', d => y(d.highestOrderPrice))
        .attr('stroke', d => d.color)
        .attr('stroke-width', 2)
        .style('cursor', 'pointer')
        .on('mouseover', function (event: MouseEvent, d: UserSpendingData) {
            d3.select(this).attr('stroke-width', 3);

            svg.append('g')
                .attr('class', 'tooltip')
                .attr('transform', `translate(${x(d.userName) ?? 0 + x.bandwidth() / 2},${y(d.highestOrderPrice) - 10})`)
                .append('text')
                .attr('text-anchor', 'middle')
                .style('font-size', '12px')
                .text(`Max: £${d3.format(",.2f")(d.highestOrderPrice)}`);
        })
        .on('mouseout', function () {
            d3.select(this).attr('stroke-width', 2);
            svg.selectAll('.tooltip').remove();
        });

    userGroups.append('line')
        .attr('class', 'lowest-price-marker')
        .attr('x1', -5)
        .attr('x2', 5)
        .attr('y1', d => y(d.lowestOrderPrice))
        .attr('y2', d => y(d.lowestOrderPrice))
        .attr('stroke', d => d.color)
        .attr('stroke-width', 2)
        .style('cursor', 'pointer')
        .on('mouseover', function (event, d) {
            d3.select(this).attr('stroke-width', 3);

            svg.append('g')
                .attr('class', 'tooltip')
                .attr('transform', `translate(${x(d.userName) ?? 0 + x.bandwidth() / 2},${y(d.lowestOrderPrice) + 20})`)
                .append('text')
                .attr('text-anchor', 'middle')
                .style('font-size', '12px')
                .text(`Min: £${d3.format(",.2f")(d.lowestOrderPrice)}`);
        })
        .on('mouseout', function () {
            d3.select(this).attr('stroke-width', 2);
            svg.selectAll('.tooltip').remove();
        });

    // User links
    svg.selectAll('.user-link')
        .data(data)
        .enter()
        .append('a')
        .attr('href', d => `/user/${d.userId}`)
        .attr('class', 'user-link')
        .append('rect')
        .attr('x', d => x(d.userName) ?? 0)
        .attr('y', 0)
        .attr('width', x.bandwidth())
        .attr('height', chartHeight)
        .attr('fill', 'transparent')
        .style('cursor', 'pointer');

    updateUserSpendingLegend(data, legendId);
}

function updateLegend(data: ProductData[], legendId: string): void {
    const container = document.getElementById(legendId);
    if (!container) return;

    container.style.overflow = 'visible';
    container.innerHTML = '';

    data.forEach(product => {
        const item = document.createElement('div');
        item.className = 'flex items-center gap-2 mb-1';

        const color = document.createElement('div');
        color.className = 'w-4 h-4 flex-shrink-0';
        color.style.backgroundColor = product.color;

        const label = document.createElement('a');
        label.href = `/product/${product.id}`;
        label.className = 'text-sm hover:underline';
        label.style.cursor = 'pointer';
        label.textContent = `${product.name} (${product.sales})`;

        item.appendChild(color);
        item.appendChild(label);
        container.appendChild(item);
    });
}

function updateUserSpendingLegend(data: UserSpendingData[], legendId: string): void {
    const container = document.getElementById(legendId);
    if (!container) return;

    container.style.overflow = 'visible';
    container.innerHTML = '';

    data.forEach(user => {
        const item = document.createElement('div');
        item.className = 'flex items-center justify-between gap-2 mb-2';

        const colorwithname = document.createElement('div');
        colorwithname.className = 'flex items-center gap-2'

        const color = document.createElement('div');
        color.className = 'w-4 h-4 flex-shrink-0';
        color.style.backgroundColor = user.color;

        const link = document.createElement('a');
        link.href = `/user/${user.userId}`;
        link.className = 'text-sm font-medium hover:underline';
        link.style.cursor = 'pointer';
        link.textContent = user.userName;

        const stats = document.createElement('span');
        stats.className = 'text-xs text-black/60 dark:text-white/60 ml-2';
        stats.textContent = `Total: £${user.totalSpent.toFixed(2)} | Avg: £${user.avgOrderPrice.toFixed(2)} | Orders: ${user.orderCount}`;

        colorwithname.appendChild(color);
        colorwithname.appendChild(link);
        item.appendChild(colorwithname)
        item.appendChild(stats);
        container.appendChild(item);
    });
}

// Initialization
document.addEventListener('DOMContentLoaded', () => {
    // Add styles
    document.head.appendChild(Object.assign(document.createElement('style'), {
        textContent: `
            #product-sales-chart, #product-sales-chart svg, #product-legend,
            #product-sales-chart2, #product-sales-chart2 svg, #product-legend2,
            #user-spending-chart, #user-spending-chart svg, #user-spending-legend {
                overflow: visible !important;
            }
            .bar-link, .user-link {
                cursor: pointer;
                transition: transform 0.1s ease-in-out;
            }
            .bar-link:hover, .user-link:hover {
                transform: scale(1.02);
            }
            .avg-price-marker {
                transition: r 0.2s ease-in-out, stroke-width 0.2s ease-in-out;
            }
            .price-range-line, .highest-price-marker, .lowest-price-marker {
                transition: stroke-width 0.2s ease-in-out;
            }
        `
    }));

    // Load data and create charts
    Promise.all([
        queryData('best-selling', 10).then(data => {
            bestSellingData = data as ProductData[];
            //createBarChart(bestSellingData, 'product-sales-chart', 'product-legend');
            createPieChart(bestSellingData, 'product-sales-chart', 'product-legend');
        }),
        queryData('worst-selling', 10).then(data => {
            worstSellingData = data as ProductData[];
            createPieChart(worstSellingData, 'product-sales-chart2', 'product-legend2');
        }),
        queryData('top-spending-users', 10).then(data => {
            topSpendingUsersData = data as UserSpendingData[];
            createUserSpendingChart(topSpendingUsersData, 'user-spending-chart', 'user-spending-legend');
        })
    ]).catch((err: Error) => console.error('Error loading chart data:', err));
});

// Handle window resizing
window.addEventListener('resize', debounce(() => {
    if (bestSellingData.length) createPieChart(bestSellingData, 'product-sales-chart', 'product-legend');
    if (worstSellingData.length) createPieChart(worstSellingData, 'product-sales-chart2', 'product-legend2');
    if (topSpendingUsersData.length) createUserSpendingChart(topSpendingUsersData, 'user-spending-chart', 'user-spending-legend');
}, 250));

function debounce<T extends (...args: any[]) => any>(func: T, wait: number): (...args: Parameters<T>) => void {
    let timeout: number;
    return function (this: any) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, Array.prototype.slice.call(arguments)), wait);
    };
}
