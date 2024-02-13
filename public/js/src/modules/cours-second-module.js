pdfjsLib.GlobalWorkerOptions.workerSrc = '/js/dist/pdfjs.worker.js';
var scale = 1.5;

$(document).ready(function () {
    $('.course-canvas').each(function () {
        var pageCount = 0;
        var canvas = this;
        var pdfUrl = $(canvas).data('pdf-url');
        var pdfDoc = null; // Variable pour stocker le document PDF
        var ctx = canvas.getContext('2d');
        var pageNum = 1;

        function renderPage(num) {
            pdfDoc.getPage(num).then(function (page) {
                var viewport = page.getViewport({ scale: scale });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                var renderTask = page.render(renderContext);

                renderTask.promise.then(function () {
                    if (pageNum === 1) {
                        $('#prev-btn').hide();
                    } else {
                        $('#prev-btn').show();
                    }

                    if (pageNum === pdfDoc.numPages) {
                        $('#next-btn').hide();
                    } else {
                        $('#next-btn').show();
                    }
                    pageCount = pdfDoc.numPages;
                    document.getElementById("page-num").textContent = pageNum;
                    document.getElementById("page-count").textContent = pageCount;
                });
            });
        }

        // Fonction pour charger un nouveau PDF
        function loadPDF(pdfUrl) {
            pdfjsLib.getDocument(pdfUrl).promise.then(function (pdfDoc_) {
                pdfDoc = pdfDoc_;
                renderPage(pageNum);
            });
        }

        loadPDF(pdfUrl);

        $('#prev-btn').click(function () {
            if (pageNum > 1) {
                pageNum--;
                renderPage(pageNum);
            }
        });

        $('#next-btn').click(function () {
            if (pageNum < pdfDoc.numPages) {
                pageNum++;
                renderPage(pageNum);
            }
        });

        // Gestionnaire d'événements pour les éléments du sommaire
        $('#sommaire li').click(function () {
            var targetPage = $(this).data('page');
            if (targetPage && targetPage !== pageNum) {
                pageNum = targetPage;
                renderPage(pageNum);
            }
        });
    });
});
