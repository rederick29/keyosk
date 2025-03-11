import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

// If you're using three.interactive, make sure it's installed properly
// import { InteractionManager } from 'three.interactive';

//! SCENE INIT
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(70);
camera.position.x = 1;
camera.position.y = 1;
camera.position.z = 1;
camera.lookAt(new THREE.Vector3(0, 0, 0));

const canvas = document.getElementById('canvas') as HTMLCanvasElement;
const renderer = new THREE.WebGLRenderer({
    antialias: true,
    canvas: canvas,
    alpha: true // Make background transparent to show gradient
});

const controls = new OrbitControls(camera, canvas);
controls.target.set(1, 0, 1);
controls.update();

//! LIGHTING
const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
scene.add(ambientLight);

const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
directionalLight.position.set(1, 1, 1);
scene.add(directionalLight);

//! KEYOSK KEYS
{
    const objLoader = new GLTFLoader();
    objLoader.load('storage/images/static/abc.glb', (root) => {
        root.scene.scale.set(0.1, 0.1, 0.1);
        root.scene.position.set(0, 0, 0);

        const mat = new THREE.MeshPhongMaterial({
            color: 0xB454DD,
            specular: 0x000000,
            shininess: 0.5,
            transparent: true
        });

        root.scene.traverse((child) => {
            if (child instanceof THREE.Mesh) {
                child.material = mat;
            }
        }
        );

        scene.add(root.scene);

        for (let i = 0; i < 10; i++) {
            let key = root.scene.clone();
            key.position.x = i * 0.2;
            scene.add(key);

            for (let j = 0; j < 10; j++) {
                let key = root.scene.clone();
                key.position.x = i * 0.2;
                key.position.z = j * 0.2;
                scene.add(key);
            }
        }
    });
}

// Set initial size
updateSize();

// Comment out InteractionManager if you don't have three.interactive properly set up
/*
const interactionManager = new InteractionManager(
    renderer,
    camera,
    renderer.domElement
);
// interactionManager.add(mesh); // Uncomment if you need interaction
*/

// Animation loop
renderer.setAnimationLoop(animate);

function animate(time: number) {

    // NO ROTATION!!
    // Iterate through every item in the scene and change their colours slowly
    scene.traverse((child) => {
        if (child instanceof THREE.Mesh) {
            const hue = (time * 0.0001) % 1;
            const color = new THREE.Color().setHSL(hue, 1, 0.5);
            (child.material as THREE.MeshPhongMaterial).color = color;
        }
    });

    renderer.render(scene, camera);
}

// Handle resizing
window.addEventListener('resize', updateSize);

function updateSize() {
    if (!canvas) return;

    // Get the parent container dimensions
    const container = canvas.parentElement;
    if (!container) return;

    const width = container.clientWidth;
    const height = container.clientHeight;

    // Update camera aspect ratio
    camera.aspect = width / height;
    camera.updateProjectionMatrix();

    // Update renderer size
    renderer.setSize(width, height);
}
