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