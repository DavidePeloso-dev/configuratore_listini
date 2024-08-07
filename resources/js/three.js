import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js'
import { RoundedBoxGeometry } from 'three/examples/jsm/geometries/RoundedBoxGeometry.js'

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, (window.innerWidth - 300) / (window.innerHeight - 56), 0.1, 1000);
const renderer = new THREE.WebGLRenderer({
    antialias: 1,

});
//definito il colore di sfondo
renderer.setClearColor(0x000000, 0)

const pixelRatio = Math.min(window.devicePixelRatio, 2)
renderer.setPixelRatio(pixelRatio)
//definita la ratio della scena da renderizzare
renderer.setSize(window.innerWidth - 300, window.innerHeight - 56);
//appeso il canvas al DOM
document.querySelector('.three_container').appendChild(renderer.domElement);

window.addEventListener('resize', () => {

    camera.aspect = (window.innerWidth - 300) / (window.innerHeight - 56)
    camera.updateProjectionMatrix()

    renderer.setSize((window.innerWidth - 300), (window.innerHeight - 56))

    const pixelRatio = Math.min(window.devicePixelRatio, 2)
    renderer.setPixelRatio(pixelRatio)

})


//definizione controllo orbitale della camera
const controls = new OrbitControls(camera, renderer.domElement)
//controls.autoRotate = 1
//controls.autoRotateSpeed = 0.8
controls.enableDamping = true
controls.minPolarAngle = Math.PI * 0.1
controls.maxPolarAngle = Math.PI * 0.60

//funzione di aggiornameto frame
function tic() {
    //const deltaTime = clock.getDelta()
    controls.update()
    renderer.render(scene, camera)
    requestAnimationFrame(tic)
}
renderer.render(scene, camera)

requestAnimationFrame(tic)
//Spostamento della camera per visualizzare il modello
camera.position.z = 3

// Aggiungi una luce direzionale che genera ombre
const directionLight = new THREE.DirectionalLight(0xffffff, 1.3);
directionLight.position.set(-2, 2, 1).normalize();
scene.add(directionLight);

// Aggiungi una luce direzionale che genera ombre
const directionalLight = new THREE.DirectionalLight(0xffffff, 2);
directionalLight.position.set(2, 1.5, 1).normalize();
scene.add(directionalLight);

// Aggiungi una luce ambientale
const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
scene.add(ambientLight);

//define materials
let anteMaterial = new THREE.MeshLambertMaterial({ color: 0xffffff });
let fianchiMaterial = new THREE.MeshLambertMaterial({ color: 0xffffff });
let coperchioMaterial = new THREE.MeshLambertMaterial({ color: 0xffffff });
let schienaMaterial = new THREE.MeshLambertMaterial({ color: 0xFFB13C });

const catalogs = document.querySelectorAll('.catalog');
catalogs.forEach(catalog => {
    catalog.addEventListener('click', () => {
        let articles = document.querySelectorAll('.article');

        let articlesToRender = [];
        let armadioMontato;

        articles.forEach(article => {
            article.addEventListener('click', () => {
                let articleResp = JSON.parse(article.getAttribute('data-article'))
                console.log(articleResp);
                console.log(articleResp);
                if (typeof armadioMontato !== 'undefined') {
                    scene.remove(armadioMontato)
                }
                armadioMontato = createArmadio(articleResp)
                articlesToRender.push(armadioMontato);
                // Aggiungi l'armadio alla scena
                scene.add(armadioMontato);

                console.log(articlesToRender);
            })
        })
    })
})


function doorsDimention(armadio) {
    if (armadio.width >= 0.75) {
        return armadio.width / 2 - 0.002
    } else {
        return armadio.width - 0.002
    }
}

function doorsDuble(armadio) {
    if (armadio.width >= 0.75) {
        return true
    } else {
        return false
    }
}

function createArmadio(armadio) {
    console.log(armadio.components['Zoccolo']);
    // Crea geometrie basate sulla nuova larghezza dell'armadio
    let geometryF = new RoundedBoxGeometry(armadio.components['Fianchi'], armadio.height - 0.005, armadio.depth - 0.022, 3, 0.001);
    let geometryC = new RoundedBoxGeometry(armadio.width - armadio.components['Fianchi'] * 2, armadio.components['Coperchio'], armadio.depth - 0.022, 3, 0.001);
    let geometryZ = new RoundedBoxGeometry(armadio.width - armadio.components['Fianchi'] * 2, armadio.components['Zoccolo'] + 0.002, armadio.components['Zoccolo'], 3, 0.001);
    let geometryZR = new RoundedBoxGeometry(armadio.width - armadio.components['Fianchi'] * 6, armadio.components['Zoccolo'] + 0.002, armadio.components['Zoccolo'], 3, 0.001);
    let geometryS = new THREE.BoxGeometry(armadio.width - armadio.components['Fianchi'] * 2, armadio.height - 0.005 - ((armadio.components['Coperchio'] * 2) + armadio.components['Zoccolo'] + 0.002), 0.005);
    let geometryA = new RoundedBoxGeometry(doorsDimention(armadio), armadio.height - 0.03, armadio.components['Anta Sx'], 3, 0.001);

    const fiancoSx = new THREE.Mesh(geometryF, fianchiMaterial);
    const fiancoDx = fiancoSx.clone();
    const schiena = new THREE.Mesh(geometryS, schienaMaterial);
    const coperchio = new THREE.Mesh(geometryC, coperchioMaterial);
    const fondo = coperchio.clone();
    const zoccolo = new THREE.Mesh(geometryZ, fianchiMaterial);
    const antaSx = new THREE.Mesh(geometryA, anteMaterial);
    const zoccoloR = new THREE.Mesh(geometryZR, coperchioMaterial);
    zoccoloR.geometry.parameters.width = armadio.width - armadio.components['Fianchi'] * 5;
    let antaDx;
    if (doorsDuble(armadio)) {
        antaDx = antaSx.clone();
    }

    fiancoSx.position.x = (armadio.width / -2) + armadio.components['Fianchi'] / 2;
    fiancoDx.position.x = fiancoSx.position.x * -1;
    schiena.position.set(0, 0.009, (armadio.depth - 0.022) / -2 + 0.016);
    coperchio.position.y = (armadio.height - 0.005) / 2 - armadio.components['Coperchio'] / 2;
    fondo.position.y = (coperchio.position.y * -1) + 0.02;
    zoccolo.position.set(0, (coperchio.position.y * -1) + 0.001, (armadio.depth - 0.022) / 2 - armadio.components['Anta Sx'] / 2);
    zoccoloR.position.set(0, zoccolo.position.y, zoccolo.position.z * -1 + 0.1);
    antaSx.position.set((armadio.width / -2) + (doorsDimention(armadio) / 2) + 0.001, (((armadio.height - 0.005) - (armadio.height - 0.030)) / 2) - 0.001, (armadio.depth - 0.022) / 2 + armadio.components['Anta Sx'] / 2 + 0.001);
    if (doorsDuble(armadio)) {
        antaDx.position.set(antaSx.position.x * -1, antaSx.position.y, antaSx.position.z);
    }

    let armadioMontato = new THREE.Group();
    armadioMontato.add(fiancoSx, fiancoDx, schiena, coperchio, fondo, zoccolo, zoccoloR, antaSx);
    if (doorsDuble(armadio)) {
        armadioMontato.add(antaDx);
    }

    //dichiarazione posizione elementi
    armadioMontato.rotation.y = Math.PI / 6

    return armadioMontato;
}
