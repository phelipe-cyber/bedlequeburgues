var MENU;  // Define MENU in a global scope

var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        MENU = JSON.parse(xhr.responseText);

    }
};

// xhr.open("GET", "../pdv/mvc/model/dados.php", true);
xhr.open("GET", "./dados.php", true);
xhr.setRequestHeader("Cache-Control", "no-cache");
xhr.send();

