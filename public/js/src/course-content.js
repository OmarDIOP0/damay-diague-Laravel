var url = '';
var pdfDoc = null;

var pageNum = 1,
  pageCount = 1,
  pageRendering = false,
  pageNumPending = null,
  scale = 1.5,
  canvas = document.getElementById('course-content'),
  ctx = canvas.getContext('2d');

let pdfjsLib = window['pdfjs-dist/build/pdf'];

$(() => {
  // $('.ui.sidebar').sidebar({
  //   context: $('.ui.pushable.segment'),
  //   transition: 'overlay'
  // }).sidebar('attach events', '#mobile_item');

  pdfjsLib.GlobalWorkerOptions.workerSrc = '/js/dist/pdfjs.worker.js';
  var path = window.location.href

  path = path.split("/");
  url = "/cours/1693948146.pdf";

  if (url.length > 0) {

    pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
      pdfDoc = pdfDoc_;
      //document.getElementById('page_count').textContent = pdfDoc.numPages;
      // Initial/first page rendering
      renderPage(1);
    });
  }
});

function renderPage(num) {
  pageRendering = true;
  // Using promise to fetch the page
  pdfDoc.getPage(num).then(function (page) {
    var viewport = page.getViewport({ scale: scale });
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);

    // Wait for rendering to finish
    renderTask.promise.then(function () {
      pageRendering = false;
      if (pageNumPending !== null) {
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });
  // Update page counters
  document.getElementById('page_num').textContent = num;
}

function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;
  queueRenderPage(pageNum);
}
$("#prev").click(onPrevPage);

function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;
  queueRenderPage(pageNum);
}

$("#next").click(onNextPage);

$('.sommaire-item').click((e) => {
  var page = e.currentTarget.id;
  if (page > pageNum) {
    let p = page - pageNum;
    for (var i = 0; i < p; i++) {
      onNextPage();
    }
  } else {
    let p = pageNum - page;
    for (var j = 0; j < p; j++) {
      onPrevPage();
    }
  }
})

$("#btn-back").click(() => {
  window.location.href = "/cours/";
})

$("#sommaire").click(e => {
  let id = e.currentTarget.id

  $('html, body').animate({
    scrollTop: $("#" + id).offset().top
  }, 1000)
})

function goBack() {
  window.history.back();
}
