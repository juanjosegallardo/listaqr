

setInterval(()=>{
    fetch("api/grupos")
    .then(response=>response.json())
    .then(data=>{
        for(let i in data)
        {

            document.getElementById("td_"+ data[i].grupo +"_total").innerText= data[i].total ;
            document.getElementById("td_"+ data[i].grupo +"_asistentes").innerText= data[i].asistentes ;
            document.getElementById("td_"+ data[i].grupo +"_faltantes").innerText=  data[i].total - data[i].asistentes ;
        }
    })
}, 1000)