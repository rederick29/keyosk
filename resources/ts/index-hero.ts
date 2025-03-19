import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import * as CANNON from 'cannon-es';
import {Box3, Color, Object3D, Raycaster, Vector2} from "three";

function deg2rad(degrees: number): number {
    return degrees * (Math.PI / 180);
}

const scene = new THREE.Scene();
// aruns original camera
// const camera = new THREE.PerspectiveCamera(25);
// camera.position.set(0, 8.5, 45);
// camera.lookAt(0, 2, 0);

// bens attempt at a camera
const camera = new THREE.PerspectiveCamera(35, window.innerWidth / window.innerHeight, 0.1, 1000);
camera.position.set(0, -1, 25);
camera.lookAt(0, -1, 0);

const canvas: HTMLCanvasElement | OffscreenCanvas | undefined  = document.getElementById('canvas') as HTMLCanvasElement | OffscreenCanvas | undefined;
if (!(canvas instanceof HTMLCanvasElement)) {
    throw new Error('Canvas not found');
}
const renderer = new THREE.WebGLRenderer({
    canvas,
    antialias: true,
    alpha: true
});

const raycaster: Raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();
let intersectedObject: any | null = null;
let clickedObject: any | null = null;
let isDragging: boolean = false;
let draggedBody: CANNON.Body | null = null;
let previousMousePosition: Vector2 = new THREE.Vector2();
let mouseVelocity: Vector2 = new THREE.Vector2();
let lastMousePositions: any[] = [];

const mousePositionHistorySize = 5;

const loadedModels: Object3D[] = [];
const physicsBodies: { [key: string]: CANNON.Body } = {};

// Create physics world
const world = new CANNON.World();
world.gravity.set(0, -20, 0);

const floorBody = new CANNON.Body({
    mass: 0,
    shape: new CANNON.Plane()
});
floorBody.quaternion.setFromAxisAngle(new CANNON.Vec3(1, 0, 0), -Math.PI / 2);
floorBody.position.set(0, -2, 0);
world.addBody(floorBody);

const leftWallBody = new CANNON.Body({
    mass: 0,
    shape: new CANNON.Plane()
});
leftWallBody.quaternion.setFromAxisAngle(new CANNON.Vec3(0, 1, 0), Math.PI / 2);
leftWallBody.position.set(-20, 10, 0);
world.addBody(leftWallBody);

const rightWallBody = new CANNON.Body({
    mass: 0,
    shape: new CANNON.Plane()
});
rightWallBody.quaternion.setFromAxisAngle(new CANNON.Vec3(0, 1, 0), -Math.PI / 2);
rightWallBody.position.set(20, 10, 0);
world.addBody(rightWallBody);

const physicalMat = new THREE.MeshPhysicalMaterial({
    color: 0xFFFFFF,
    clearcoat: 0.1,
    clearcoatRoughness: 0.8,
    reflectivity: 0.05,
    metalness: 0.0,
    roughness: 0.7,
});

const ambientLight = new THREE.AmbientLight(0xffffff, 1.0);
scene.add(ambientLight);

const directionalLight = new THREE.DirectionalLight(0xffffff, 0.7);
directionalLight.position.set(0, 30, 10);
directionalLight.lookAt(-10, 0, 0);
directionalLight.castShadow = true;
directionalLight.shadow.mapSize.width = 1024;
directionalLight.shadow.mapSize.height = 1024;
scene.add(directionalLight);

function loadModels() {
    const loader = new GLTFLoader();
    const characters = ['K', 'E', 'Y', 'O', 'S', 'K'];
    characters.reverse();

    for (let i = 0; i < characters.length; i++) {
        loader.load(`storage/images/static/${characters[i]}.glb`, (gltf) => {
            const model = gltf.scene;
            model.scale.set(1, 1, 1);
            model.rotation.set(deg2rad(90), 0, 0);
            model.name = characters[i];

            model.userData = {
                character: characters[i],
                originalColor: 0xFFFFFF,
                hoverColor: 0xFF00FF,
                isClickable: true
            };

            //  k
            // e y
            //o s k
            // switch (characters[i]) {
            //     case 'K':
            //         if (i === 0) {
            //             // First K
            //             model.position.set(0, 8, 0);
            //         } else {
            //             // Last K
            //             model.position.set(2.25, 1, 0);
            //         }
            //         break;
            //     case 'E':
            //         model.position.set(-1.25, 5, 0);
            //         break;
            //     case 'Y':
            //         model.position.set(1.25, 5, 0);
            //         break;
            //     case 'O':
            //         model.position.set(-2.25, 1, 0);
            //         break;
            //     case 'S':
            //         model.position.set(0, 1, 0);
            //         break;
            // }

            // k e y o s k
            switch (characters[i]) {
                case 'K':
                    if (i === 0) {
                        // First K
                        model.position.set(-6.25, 1, 0);
                    } else {
                        // Last K
                        model.position.set(6.25, 1, 0);
                    }
                    break;
                case 'E':
                    model.position.set(-3.75, 1, 0);
                    break;
                case 'Y':
                    model.position.set(-1.25, 1, 0);
                    break;
                case 'O':
                    model.position.set(1.25, 1, 0);
                    break;
                case 'S':
                    model.position.set(3.75, 1, 0);
                    break;
            }

            model.traverse((child) => {
                if (child instanceof THREE.Mesh) {
                    child.material = physicalMat.clone();
                    child.material.clearcoat = 0.5;
                    child.material.reflectivity = 0.5;
                    child.castShadow = true;
                    child.receiveShadow = true;
                }
            });

            scene.add(model);
            loadedModels.push(model);

            createPhysicsBody(model);
        });
    }

    // for (let i = 0; i < 20; i++) {
    //     const randomCharacter = characters[Math.floor(Math.random() * characters.length)];
    //     loader.load(`storage/images/static/${randomCharacter}.glb`, (gltf) => {
    //         const model = gltf.scene;

    //         // Get a random distance away (on the z)
    //         const distLower = -15;
    //         const distUpper = -300;
    //         model.position.z = Math.random() * (distUpper - distLower) + distLower;

    //         // The further away, the larger the range of x (positive and negative)
    //         const xRange = 175 + Math.abs(model.position.z) / 175;
    //         model.position.x = (Math.random() - 0.5) * xRange;


    //         // The further away, the bigger the letter
    //         const distanceAway = -model.position.z;
    //         model.scale.set(distanceAway / 15, distanceAway / 15, distanceAway / 15);

    //         // Rotate the letter randomly
    //         model.rotation.set(deg2rad(90), 0, Math.random() * Math.PI * 2);

    //         model.traverse((child) => {
    //             if (child instanceof THREE.Mesh) {
    //                 child.material = physicalMat.clone();

    //                 // TODO: mess with the color more
    //                 const hue = Math.random();
    //                 const color = new THREE.Color().setHSL(hue, 1, 0.1);
    //                 child.material.color = color;
    //             }
    //         });

    //         scene.add(model);
    //     });


    loader.load('storage/images/static/SHOP_NOW.glb', (gltf) => {
        const shopNowModel = gltf.scene;
        shopNowModel.scale.set(1, 1, 1);
        shopNowModel.position.set(-13, 5, 0);
        // shopNowModel.rotation.set(deg2rad(90), 0, 0);
        shopNowModel.userData = {
            character: 'SHOP_NOW',
            originalColor: 0xFFFFFF,
            hoverColor: 0xFF00FF,
            isClickable: true
        };

        shopNowModel.traverse((child) => {
            if (child instanceof THREE.Mesh) {
                child.material = physicalMat.clone();
                child.material.color.set(0xFFFFFF);
                child.material.clearcoat = 0.5;
                child.material.reflectivity = 0.5;
                child.castShadow = true;
                child.receiveShadow = true;
            }
        });

        loadedModels.push(shopNowModel);
        scene.add(shopNowModel);
        createPhysicsBody(shopNowModel, true);
    });
}

function createPhysicsBody(object: Object3D, isStatic = false) {
    const bbox: Box3 = new THREE.Box3().setFromObject(object);
    const size = new THREE.Vector3();
    bbox.getSize(size);

    const halfSize = {
        x: size.x / 2,
        y: size.z / 2,
        z: size.y / 2
    };

    const boxShape = new CANNON.Box(new CANNON.Vec3(
        halfSize.x,
        halfSize.y,
        halfSize.z
    ));

    const body = new CANNON.Body({
        mass: 3,
        shape: boxShape,
        position: new CANNON.Vec3(
            object.position.x,
            object.position.y,
            0
        )
    });

    body.type = isStatic ? CANNON.Body.KINEMATIC : CANNON.Body.DYNAMIC;

    const q = new CANNON.Quaternion();
    q.setFromAxisAngle(new CANNON.Vec3(1, 0, 0), deg2rad(90));
    body.quaternion.copy(q);
    body.fixedRotation = false;
    body.angularFactor.set(0, 0, 1);

    world.addBody(body);
    physicsBodies[object.uuid] = body;
}

// let animTimer: number = 0;

function onMouseMove(event: any): void {
    previousMousePosition.copy(mouse);

    if (!canvas || !(canvas instanceof HTMLCanvasElement)) {
        throw new Error('fuck you');
    }

    const rect: DOMRect = canvas.getBoundingClientRect();
    mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
    mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;

    // Update mouse position history for velocity calculation
    lastMousePositions.push({
        position: mouse.clone(),
        time: performance.now()
    });

    // Keep only recent positions
    if (lastMousePositions.length > mousePositionHistorySize) {
        lastMousePositions.shift();
    }

    // Update dragged object if dragging
    if (isDragging && draggedBody) {
        // Convert screen space mouse to world space
        const mouseWorld = screenToWorld(mouse);

        // Move the physics body to follow the mouse
        draggedBody.position.x = mouseWorld.x;
        draggedBody.position.y = mouseWorld.y;

        // Stop any existing motion
        draggedBody.velocity.set(0, 0, 0);
        draggedBody.angularVelocity.set(0, 0, 0);
    }
}

// Convert screen coordinates to world coordinates
function screenToWorld(screenPos: any)  {
    // Create a ray from the camera
    raycaster.setFromCamera(screenPos, camera);

    // Define a plane at z=0 (our objects' z-position)
    const dragPlane = new THREE.Plane(new THREE.Vector3(0, 0, 1), 0);

    // Find where the ray intersects the plane
    const worldPos = new THREE.Vector3();
    raycaster.ray.intersectPlane(dragPlane, worldPos);

    return worldPos;
}

function onMouseDown(event: any): void {
    if (!canvas || !(canvas instanceof HTMLCanvasElement)) {
        throw new Error('fuck you');
    }
    const rect: DOMRect = canvas.getBoundingClientRect();
    mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
    mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;

    raycaster.setFromCamera(mouse, camera);

    const intersects = raycaster.intersectObjects(loadedModels, true);

    if (intersects.length > 0) {
        const object = getParentGroup(intersects[0].object);

        if (object && object.userData.isClickable) {
            if (clickedObject && clickedObject !== object) {
                resetObjectColor(clickedObject);
            }

            clickedObject = object;
            setObjectColor(object, object.userData.hoverColor);

            // Start dragging
            const body = physicsBodies[object.uuid];
            if (body) {
                isDragging = true;
                draggedBody = body;

                // Reset the mouse position history
                lastMousePositions = [];
                lastMousePositions.push({
                    position: mouse.clone(),
                    time: performance.now()
                });
            }

            console.log(`Selected ${object.userData.character}`);
        }
    } else if (clickedObject) {
        resetObjectColor(clickedObject);
        clickedObject = null;
    }
}

function onMouseUp(event: any): void {
    if (isDragging && draggedBody) {
        // Calculate mouse velocity based on recent movement history
        calculateMouseVelocity();

        // Apply impulse based on mouse movement speed (flinging)
        const velocity: number = mouseVelocity.length();
        // If near zero, just drop the object
        const impulseStrength = velocity < 0.1 ? 0 : velocity;

        if (impulseStrength > 1) {
            // Normalize and apply velocity direction
            const direction = mouseVelocity.clone().normalize();
            draggedBody.applyImpulse(
                new CANNON.Vec3(
                    direction.x * impulseStrength,
                    direction.y * impulseStrength,
                    0
                ),
                new CANNON.Vec3(0, 0, 0)
            );

            // Add some random rotation for more natural movement
            draggedBody.angularVelocity.set(
                (Math.random() - 0.5) * 3,
                (Math.random() - 0.5) * 3,
                (Math.random() - 0.5) * 3
            );
        }
    }

    // Reset dragging state
    isDragging = false;
    draggedBody = null;
    lastMousePositions = [];
}

function calculateMouseVelocity() {
    if (lastMousePositions.length < 2) {
        mouseVelocity.set(0, 0);
        return;
    }

    // Get the oldest and newest positions
    const oldest = lastMousePositions[0];
    const newest = lastMousePositions[lastMousePositions.length - 1];

    // Calculate time difference in seconds
    const timeDiff = (newest.time - oldest.time) / 1000;
    if (timeDiff === 0) {
        mouseVelocity.set(0, 0);
        return;
    }

    // Calculate velocity in screen space
    const deltaX = newest.position.x - oldest.position.x;
    const deltaY = newest.position.y - oldest.position.y;

    // Convert to world space velocity (scale factor is empirical)
    mouseVelocity.set(deltaX / timeDiff * 10, deltaY / timeDiff * 10);
}

function getParentGroup(object: Object3D) {
    let current = object;

    while (current && !current.userData.character) {
        if (!current.parent) break;
        current = current.parent;
    }

    return current.userData.character ? current : null;
}

function setObjectColor(object: Object3D, color: Color): void {
    object.traverse((child) => {
        if (child instanceof THREE.Mesh &&
            child.material instanceof THREE.MeshPhysicalMaterial) {
            child.material.color.set(color);
            child.material.needsUpdate = true;
        }
    });
}

function resetObjectColor(object: Object3D): void {
    object.traverse((child) => {
        if (child instanceof THREE.Mesh &&
            child.material instanceof THREE.MeshPhysicalMaterial) {
            child.material.color.set(object.userData.originalColor);
            child.material.needsUpdate = true;
        }
    });
}

function updateSize() {
    if (!canvas) return;

    if (!canvas || !(canvas instanceof HTMLCanvasElement)) {
        throw new Error('fuck you');
    }

    const container: HTMLElement | null = canvas.parentElement;
    if (!container) return;

    const width = container.clientWidth;
    const height = container.clientHeight;

    camera.aspect = width / height;
    camera.updateProjectionMatrix();

    renderer.setSize(width, height);
}

function animate() {
    requestAnimationFrame(animate);

    world.fixedStep();

    loadedModels.forEach(model => {
        const body = physicsBodies[model.uuid];

        if (model.position.y < -10) {
            body.position.set(
                (Math.random() - 0.5) * 10,
                15,
                0
            );

            body.velocity.scale(0.5);
        }
        else if (model.position.y > 35) {
            body.position.y = 35;
            body.velocity = new CANNON.Vec3(0, -1.5, 0);
        }

        body.position.z = 0;

        // if (model.userData.character === 'SHOP_NOW') {
        //     const quaternionX = new CANNON.Quaternion();
        //     const quaternionZ = new CANNON.Quaternion();
        //
        //     // NOTE: order matters, first is the rightmost one
        //     quaternionX.setFromAxisAngle(new CANNON.Vec3(1, 0, 0), deg2rad(90));
        //     quaternionZ.setFromAxisAngle(new CANNON.Vec3(0, 1, 0), Math.sin(animTimer) * 0.1);
        //
        //     body.quaternion = quaternionX.mult(quaternionZ);
        //
        //     animTimer += 0.02;
        // }

        model.position.copy(body.position);
        model.quaternion.copy(body.quaternion);
    });

    raycaster.setFromCamera(mouse, camera);
    const intersects = raycaster.intersectObjects(loadedModels, true);

    if (intersectedObject && (!intersects.length ||
        getParentGroup(intersects[0].object) !== intersectedObject)) {
        resetObjectColor(intersectedObject);
        intersectedObject = null;
        document.body.style.cursor = 'default';
    }

    if (intersects.length > 0) {
        const object = getParentGroup(intersects[0].object);

        if (object && object !== intersectedObject && object !== clickedObject) {
            intersectedObject = object;
            setObjectColor(object, object.userData.hoverColor);
            document.body.style.cursor = 'pointer';
        }
    }

    renderer.render(scene, camera);
}

updateSize();
window.addEventListener('resize', updateSize);
window.addEventListener('mousemove', onMouseMove);
window.addEventListener('mousedown', onMouseDown);
window.addEventListener('mouseup', onMouseUp);
window.addEventListener('mouseleave', onMouseUp); // Handle leaving window while dragging

renderer.shadowMap.enabled = true;
renderer.shadowMap.type = THREE.PCFShadowMap;

loadModels();
animate();

// handle the switch from 2D -> 3D on home page, default to 2D for shit computers (like mine)
document.addEventListener("DOMContentLoaded", (): void => {
    const twoDElement: HTMLElement = document.getElementById('two-d-element') as HTMLElement;
    const threeDElement: HTMLElement = document.getElementById('three-d-element') as HTMLElement;
    const perspectiveSwitch: HTMLElement = document.getElementById('perspective-switch') as HTMLElement;

    // threeDElement.classList.add("hidden");
    // threeDElement.classList.add("w-full");

    perspectiveSwitch.addEventListener("click", (): void => {
        const is2D: boolean = !twoDElement.classList.contains('hidden');


        if(is2D) {
            twoDElement.classList.remove('flex');
            twoDElement.classList.add('hidden');
            threeDElement.classList.remove('hidden');
        }
        else {
            threeDElement.classList.add('hidden');
            twoDElement.classList.remove('hidden');
            twoDElement.classList.add('flex');
        }
    })
})
