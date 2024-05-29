import './bootstrap';
import {Html5QrcodeScanner} from "html5-qrcode";
import {Html5Qrcode} from "html5-qrcode";
async function onScanSuccess(qrMessage, decodeResult) {
   
            try {
                const response = await fetch(`api/entradas/${qrMessage}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
 
                const data = await response.json();
                console.log(data);

                document.getElementById('result').innerText = `${data.mensaje}`;
                document.getElementById('grupo').innerText = `${data.grupo}`;
            } catch (error) {

                console.error('Error fetching data from server:', error);
                document.getElementById('result').innerText += error;
            }
        }

        function onScanError(errorMessage) {
            // Puede usar esto para manejar los errores
            console.error(errorMessage);
        }


        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);

        const alumnoInput = document.getElementById('alumnoInput');
const alumnoList = document.getElementById('alumnoList');

alumnoInput.addEventListener('input', () => {
  const inputValue = alumnoInput.value.toUpperCase();
  if(inputValue.length > 3)
    {
    // Llamada a la API para obtener los datos de los alumnos
    fetch('api/alumnos?busqueda='+  inputValue)
        .then(response => response.json())
        .then(data => {
        const alumnos = data.map(alumno => alumno.nombre.toUpperCase());

        displayAlumnos(alumnos);
        })
        .catch(error => {
        console.error('Error al obtener datos de la API:', error);
        });
    }
    else{
        displayAlumnos([])
    }

});

function displayAlumnos(filteredAlumnos) {
  alumnoList.innerHTML = '';
  filteredAlumnos.forEach(alumno => {
    const li = document.createElement('li');
    li.textContent = alumno;
    li.addEventListener('click', () => {
      alumnoInput.value = alumno;
      alumnoList.innerHTML = '';
    });
    alumnoList.appendChild(li);
  });
}

document.addEventListener('click', (e) => {
  if (!alumnoList.contains(e.target) && e.target !== alumnoInput) {
    alumnoList.innerHTML = '';
  }
});

let boton = document.getElementById("btnBuscar");

boton.addEventListener('click', async (e) => {
    
    let busqueda = document.getElementById("alumnoInput").value;
    try {
        const response = await fetch(`api/entradas/${busqueda}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log(data);

        document.getElementById('result').innerText = `${data.mensaje}`;
        document.getElementById('grupo').innerText = `${data.grupo}`;
        document.getElementById("alumnoInput").value ="";

    } catch (error) {

        console.error('Error fetching data from server:', error);
    }

  });

