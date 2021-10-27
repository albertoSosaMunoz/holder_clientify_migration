$(()=>{
    console.log("funciones.js cargado");

    $("#btn_sinc_poppup").click(()=>{
        popSincronizandoHolderClientify();
    });

    $("#btn_sinc_holded_clientify").click(()=>{

        let sinc="sincronizarHoldedClientify";

        $.ajax({
            url: "php/scripts/script_closemarketing.php",
            type: "GET",
            dataType: "json",
            data: { action :sinc },
            cache: false,  
            beforeSend: function() {
                popSincronizandoHolderClientify();
              },
        })         
        .done(function (res) {      
            $("#sinc_status").text("SINCRONIZACION REALIZADA CON EXITO");
            setTimeout(() => {$("#modalPopup").remove();}, 3000);
            console.log("Sincronizacion realizada con exito");
        })         
        .fail(function (res) {     
            $("#sinc_status").text("ERROR EN LA SINCRONIZACION");
            setTimeout(() => {$("#modalPopup").remove();}, 3000);                               
            console.log("No se ha podido sincronizar , intentalo de nuevo en unos minutos");
        });

    });

    $("#btn_borrar_holded_clientify").click(()=>{

        let sinc="borrarHoldedTodos";

        $.ajax({
            url: "php/scripts/script_closemarketing.php",
            type: "GET",
            dataType: "json",
            data: { action :sinc },
            cache: false,  
            beforeSend: function() {
              },
        })         
        .done(function (res) {      
            console.log(res);
        })         
        .fail(function (res) {     
            console.log(res);
        });

    });
});


function popSincronizandoHolderClientify(){

    $popUp=`    <div id="modalPopup">
                    <div id="popUpActualizar" class="text-center">
                        <img src="images/sync_star.gif" id="sync_star_img"/>
                        <p id="sinc_status">SINCRONIZANDO</p>
                    </div>
                </div>`;
                
    $("body").append($popUp);
}
