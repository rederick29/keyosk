import * as d3 from "d3";

interface ProductData {
    name: string;
    sales: number;
    color: string;
    id: string | number;
}

const colorPalette = [
    "#4C72B0", "#55A868", "#C44E52", "#8172B3", "#CCB974", "#64B5CD",
    "#377EB8", "#FF7F00", "#4DAF4A", "#984EA3", "#F781BF", "#A65628"
];

let bestSellingData = [];
let worstSellingData = [];

async function queryData(endpoint, limit = 10) {
    try {
        const response = await fetch(`/admin/stats/${endpoint}?limit=${limit}`);
        if (!response.ok) throw new Error('Network response was not ok');

        const responseData = await response.json();
        if (!responseData.data || !Array.isArray(responseData.data))
            throw new Error('Unexpected data format from API');

        return responseData.data.map((product, index) => ({
            name: product.name,
            sales: product.total_sold ?? 0,
            color: colorPalette[index % colorPalette.length],
            id: product.id
        }));
    }
    catch (error) {
        console.error(`Error fetching ${endpoint} data:`, error);
        return [];
    }
}

function createBarChart(data, containerId, legendId) {
    const chartContainer = document.getElementById(containerId);
    if (!chartContainer) return;

    chartContainer.innerHTML = '';
    chartContainer.style.overflow = 'visible';

    const containerWidth = chartContainer.clientWidth;
    const containerHeight = chartContainer.clientHeight || 400;

    const margin = {
        top: Math.max(30, containerHeight * 0.08),
        right: Math.max(30, containerWidth * 0.05),
        bottom: Math.max(100, containerHeight * 0.25),
        left: Math.max(50, containerWidth * 0.1)
    };

    const width = containerWidth - margin.left - margin.right;
    const height = containerHeight - margin.top - margin.bottom;

    const svg = d3.select(`#${containerId}`)
        .append('svg')
        .attr('width', containerWidth)
        .attr('height', containerHeight)
        .attr('viewBox', `0 0 ${containerWidth} ${containerHeight}`)
        .style('overflow', 'visible')
        .append('g')
        .attr('transform', `translate(${margin.left},${margin.top})`);

    const x = d3.scaleBand()
        .domain(data.map(d => d.name))
        .range([0, width])
        .padding(0.2);

    const y = d3.scaleLinear()
        .domain([0, d3.max(data, d => d.sales) ?? 0])
        .nice()
        .range([height, 0]);

    const xAxis = svg.append('g')
        .attr('transform', `translate(0,${height})`)
        .call(d3.axisBottom(x));

    const labelAngle = data.length > 8 ? -45 : -30;

    xAxis.selectAll('text')
        .style('text-anchor', 'end')
        .style('font-size', '11px')
        .attr('transform', `translate(-10,10)rotate(${labelAngle})`)
        .style('overflow', 'visible');

    svg.append('g')
        .call(d3.axisLeft(y))
        .selectAll('text')
        .style('font-size', '11px');

    svg.append('text')
        .attr('transform', 'rotate(-90)')
        .attr('y', -margin.left + 20)
        .attr('x', -height / 2)
        .attr('text-anchor', 'middle')
        .text('Sales')
        .style('font-size', '14px');

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
        .attr('height', d => height - y(d.sales))
        .attr('fill', d => d.color)
        .style('opacity', 0.8)
        .style('cursor', 'pointer')
        .on('mouseover', function (event, d) {
            d3.select(this)
                .style('opacity', 1)
                .attr('stroke', '#333')
                .attr('stroke-width', 2);

            const tooltip = svg.append('g')
                .attr('class', 'tooltip')
                .attr('transform', `translate(${x(d.name) + x.bandwidth() / 2},${y(d.sales) - 10})`);

            tooltip.append('text')
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

function updateLegend(data, legendId) {
    const legendContainer = document.getElementById(legendId);
    if (!legendContainer) return;

    legendContainer.style.overflow = 'visible';
    legendContainer.innerHTML = '';

    data.forEach(product => {
        const legendItem = document.createElement('div');
        legendItem.className = 'flex items-center gap-2 mb-1';

        const colorBox = document.createElement('div');
        colorBox.className = 'w-4 h-4 flex-shrink-0';
        colorBox.style.backgroundColor = product.color;

        const label = document.createElement('a');
        label.href = `/product/${product.id}`;
        label.className = 'text-sm hover:underline';
        label.style.cursor = 'pointer';
        label.textContent = `${product.name} (${product.sales})`;

        legendItem.appendChild(colorBox);
        legendItem.appendChild(label);
        legendContainer.appendChild(legendItem);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const style = document.createElement('style');
    style.textContent = `
        #product-sales-chart, #product-sales-chart svg, #product-legend,
        #product-sales-chart2, #product-sales-chart2 svg, #product-legend2 {
            overflow: visible !important;
        }
        .bar-link {
            cursor: pointer;
            transition: transform 0.1s ease-in-out;
        }
        .bar-link:hover {
            transform: scale(1.02);
        }
    `;
    document.head.appendChild(style);

    queryData('best-selling', 10).then(data => {
        bestSellingData = data;
        createBarChart(bestSellingData, 'product-sales-chart', 'product-legend');
    });

    queryData('worst-selling', 10).then(data => {
        worstSellingData = data;
        createBarChart(worstSellingData, 'product-sales-chart2', 'product-legend2');
    });
});

window.addEventListener('resize', debounce(() => {
    if (bestSellingData.length > 0) {
        createBarChart(bestSellingData, 'product-sales-chart', 'product-legend');
    }
    if (worstSellingData.length > 0) {
        createBarChart(worstSellingData, 'product-sales-chart2', 'product-legend2');
    }
}, 250));

function debounce(func, wait) {
    let timeout;
    return function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, arguments), wait);
    };
}
