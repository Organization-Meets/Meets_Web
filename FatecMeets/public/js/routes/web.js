if (typeof controllerName !== "undefined" && controllerName) {
    var script = document.createElement("script");
    script.src = "/js/controllers/" + controllerName + "Controller.js";
    script.type = "text/javascript";
    script.onload = function() {
        console.log(controllerName + "Controller carregado!");
    };
    script.onerror = function() {
        console.error("Erro ao carregar " + controllerName + "Controller.js");
    };
    document.head.appendChild(script);
}