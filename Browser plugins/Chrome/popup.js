document.addEventListener('DOMContentLoaded', function() {
  var checkPageButton = document.getElementById('checkPage');
  checkPageButton.addEventListener('click', function() {

        chrome.tabs.query({active: true, lastFocusedWindow: true}, function(tabs) {

            // get the current tabID and information
            var tab = tabs[0];
            d = document;

            var f = d.createElement('form');
            f.action = 'http://99.241.105.202/ProjectReadingList/savearticles.php';
            f.method = 'post';

            var linkfield = d.createElement('input');
            linkfield.type = 'hidden';
            linkfield.name = 'link';
            linkfield.value = tab.url;

            var titlefield = d.createElement('input');
            titlefield.type = 'hidden';
            titlefield.name = 'title';
            titlefield.value = tab.title;

            //alert(tab.title);


            f.appendChild(linkfield);
            f.appendChild(titlefield);
            d.body.appendChild(f);
            f.submit();
        });

  }, false);
}, false);