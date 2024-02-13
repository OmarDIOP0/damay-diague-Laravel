import { getLevels } from "./modules/level-module.js";
let slug = "";
var easyMDE = new EasyMDE({
  autofocus: true,
  autosave: {
    enabled: false,
    uniqueId: "MyUniqueID",
    delay: 1000,
    submit_delay: 5000,
    timeFormat: {
      locale: 'fr-FR',
      format: {
        year: 'numeric',
        month: 'long',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
      },
    },
    text: "Autosaved: "
  },
  insertTexts: {
    horizontalRule: ["", "\n\n-----\n\n"],
    image: ["![](http://", ")"],
    link: ["[", "](http://)"],
    table: ["", "\n\n| Column 1 | Column 2 | Column 3 |\n| -------- | -------- | -------- |\n| Text     | Text      | Text     |\n\n"],
  },
});
let levels = [];
let currentCourseLevelId;

$(() => {
  $('select.dropdown').dropdown();
  getLevels(setLevels);
  slug = window.location.pathname.split('/')[3];
  getCourse();
})

$("#btn-add-sommaire").on('click', () => {
  $("#sommaire-list").append(`
    <li class="ui small icon input">
      <input type="text" name="sommaire-item[]" placeholder="Titre...">
    </li><br>`
  )
});

$("#form-edit-lesson").submit(e => {
  e.preventDefault();

  $.post(`/lesson/${slug}/update`, $("#form-edit-lesson").serialize()).done(response => {
    if (response.auth) {
      if (response.success) {
        $("#details-cours").modal("hide");
      } else {
        alert("Une erreur est survenu lors de la modification.");
      }
    } else {
      window.location.href = "/user-login";
    }
  }).fail(error => {
    console.log(error)
  })
})
$("#btn-view-guide").click(() => {
  $('#guide').modal('show');
});

$("#btn-details-cours").click(() => {
  $("select[name=level]").empty();

  levels.forEach(item => {
    let option = `<option value=${item.id}>${item.name}</option>`

    if (item.id == currentCourseLevelId) {
      option = `<option value=${item.id} selected>${item.name}</option>`
    }

    $("select[name=level]").append(option);
  })
  $("#details-cours").modal("show");
});

$("#btn-save").click(() => {
  $("#btn-save").addClass("loading");
  const lessonId = $("#lesson-id").val();

  let submitData = {
    'content': easyMDE.value(),
    'sommaire': $("input[name='sommaire-item[]'").map(function () {
      if ($(this).val()) {
        return $(this).val();
      }
    }).get()
  }

  if (lessonId) {
    submitData.lessonId = lessonId;
  }

  $.post('/editor/lesson/' + slug + '/save', submitData).done(response => {
    console.log(response);
    if (response) {
      alert("Le cours a été enregistré avec succes !!!");
    }

  }).fail(error => {
    alert("Une erreur s'est produite au niveau du serveur");
    console.log(error);
  });
  $("#btn-save").removeClass("loading");
})

function getCourse() {
  $.getJSON(`/editor/course/${slug}`).done(
    response => {
      console.log(response)

      $("#btn-preview").attr('href', '/lesson/' + slug + '/preview');

      easyMDE.value(response[0].content ?? '');
      currentCourseLevelId = response[0].id_level;
      $("input[name=lesson-name]").val(response[0].name);
      $("textarea[name=lesson-description]").val(response[0].desc);

      if (response[0].sommaire != null) {
        let sommaire = JSON.parse(response[0].sommaire);

        $("#sommaire-list").empty();

        sommaire.forEach(item => {
          $("#sommaire-list").append(`<li class="ui small icon input">
             <input type="text" name="sommaire-item[]" value="${item}">
             </li><br>`);
        });
      }
    }).fail(error => {
      alert("Ouups, une erreur s'est produite au niveau du serveur");
      console.log(error);
    })
}

function setLevels(data) {
  levels = data;
}