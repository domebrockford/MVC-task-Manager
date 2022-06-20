document.addEventListener('DOMContentLoaded', function () {
    var search = document.querySelector('#search');
    var results = document.querySelector('#searchresults');
    var templateContent = document.querySelector('#resultstemplate').content;
    search.addEventListener('keyup', function handler(event) {
        while (results.children.length) results.removeChild(results.firstChild);
        var inputVal = new RegExp(search.value.trim(), 'i');
        var clonedOptions = templateContent.cloneNode(true);
        var set = Array.prototype.reduce.call(clonedOptions.children, function searchFilter(frag, el) {
            if (inputVal.test(el.textContent) && frag.children.length < 5) frag.appendChild(el);
            return frag;
        }, document.createDocumentFragment());
        results.appendChild(set);
    });
}, false);
var text = $(".logout").text();
console.log(text);
var statuss = false;
function logouthover(event) {
    if (statuss == false) {
        statuss = !statuss;
        $(".logout").text("Выйти");
    }
    else {
        statuss = !statuss;
        $(".logout").text(text);
    }
}