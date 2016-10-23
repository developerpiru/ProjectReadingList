document.addEventListener('DOMContentLoaded', function() {

    var saveButton = document.getElementById('savepage');
    saveButton.addEventListener('click', function() {

        chrome.tabs.getSelected(null, function(tab) {
            d = document;

            var f = d.createElement('form');
            f.action = 'http://99.241.105.202/ProjectReadingList/savearticles.php';
            f.method = 'post';

            var urlbox = d.createElement('input');
            urlbox.type = 'hidden';
            urlbox.name = 'link';
            urlbox.value = tab.url;

            var titlebox = d.createElement('input');
            titlebox.type = 'hidden';
            titlebox.name = 'title';
            titlebox.value = tab.title;

            f.appendChild(urlbox);
            f.appendChild(titlebox);

            d.body.appendChild(f);
            f.submit();
        });
    }, false);
}, false);