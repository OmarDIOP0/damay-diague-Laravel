import { getLesson, findLesson, createPDFCourse, editLesson, setLessonStatus } from "./modules/lesson-module.js";
import { getLevels, addLevelToForm, createLevel, editLevel } from "./modules/level-module.js";
import { getCourses, displayCourses, addCourseDataToEditForm, createCourse, editCourse } from "./modules/course-module.js";
import { createLessonTemplate, createTableTemplateForLevelItem, createListTemplateForLevelItem } from "./helpers.js";

let panelCourses = $("#panel-courses");
let panelComments = $("#panel-comments");
let panelDetailCours = $("#panel-detail-cours");
let panelClassrooms = $("#panel-levels");
let panelUsers = $("#panel-users");

var panels = [panelCourses, panelComments, panelClassrooms, panelDetailCours, panelUsers];

let selectedLevelsForCourse = [];
let levelList = [];

$(() => {
  getCourses(displayCourses);
  getLevels(setLevel);
  getUsers();

  $('select.dropdown').dropdown();
  $('.ui.radio.checkbox').checkbox();
});

$("#form-create-course").submit(e => {
  e.preventDefault();
  createCourse();
});

$("#form-edit-course").submit(e => {
  e.preventDefault();
  editCourse();
});

$("#form-create-level").submit(e => {
  e.preventDefault();
  createLevel();
});

$("#form-edit-level").submit(e => {
  e.preventDefault();
  editLevel($('input[name="id-edited-level"]').val());
});

$("#form-add-lesson").submit(e => {
  e.preventDefault();
  e.currentTarget.classList.add("loading", "disabled");
  
  var parties = $("input[name='parties[]']").map(function () {
    return $(this).val()
  }).get();

  var pages = $("input[name='pages[]']").map(function () {
    return $(this).val() ?? $(this).val();
  }).get();

  var courseId = $("#course-id").val();
  var doc = $("input[name='doc']")[0].files[0];
  var formData = new FormData();

  formData.append('lesson-name', $("input[name='lesson-name']").val());
  formData.append('lesson-description', $("textarea[name='lesson-description']").val());
  formData.append('lesson-level', $("select[name='level']").val());
  formData.append('lesson-parties', parties);
  formData.append('section-pages', pages);
  formData.append('type', 'pdf');
  formData.append('doc', doc);

  createPDFCourse(formData, courseId);

  $('#modal-add-lesson').modal('hide');
});

$("#btn-panel-create-course").click(() => {
  showPanel(panelCreateCourse);
});

$("#btn-panel-courses").click(() => {
  showPanel(panelCourses);
});

$("#btn-panel-comments").click(() => {
  showPanel(panelComments);
});

$("#btn-panel-levels").click(() => {
  showPanel(panelClassrooms);
  displayLevels();
});

$("#btn-panel-users").on('click', () => {
  showPanel(panelUsers);
})

$("#btn-show-modalAddLesson").click(() => {
  addLevelToForm();
  $('#modal-add-lesson').modal('show');
});

$("#btn-show-levelList").on('click', () => {
  $("#list-levels").empty();

  levelList.forEach(level => {
    let checked = false;

    if (selectedLevelsForCourse.find(item => level.id == item.id)) {
      checked = true;
    }

    $("#list-levels").append(createListTemplateForLevelItem(level, checked))
  });

  $("#modal-list-levels").modal("show");
});

$("#btn-save-selected-levels").click(() => {
  let checkedLevels = $(".level-item:checked")

  selectedLevelsForCourse = [];

  $("#course-levels").empty();

  for (var i = 0; i < checkedLevels.length; i++) {
    let item = levelList.find(level => level.id == checkedLevels[i].value);

    if (!selectedLevelsForCourse.find(level => level.id == item.id)) {
      let e = `<div class="ui black label">${item.name}</div>
      <input hidden value=${item.id} name="levels[]" />`;

      $("#course-levels").append(e);

      selectedLevelsForCourse.push(item)
    }
  }

  $("#modal-edit-course").modal("show")
});

$("#btn-show-modalEditCourse").click(() => {
  let selectedCourse = addCourseDataToEditForm();
  selectedLevelsForCourse = selectedCourse.levels;
  $('#modal-edit-course').modal('show');
})

$("#list-cours").on("click", '.detail', (e) => {
  let coursId = e.currentTarget.attributes['data-usage'].value;
  let coursName = e.currentTarget.attributes['name'].value;

  $("input[name='course-id']").val(coursId);

  showDetailCours(coursId, coursName);
});

$("#lesson-list").on("click", '.btn-publish', (e) => {
  e.currentTarget.classList.add("loading", "disabled");

  const lessonId = e.currentTarget.attributes['id'].value;
  const status = e.currentTarget.attributes['status'].value;

  let lessonStatus;

  status == 0 ? lessonStatus = 1 : lessonStatus = 0;

  if (setLessonStatus(lessonId, lessonStatus)) {
    window.location.reload(true);
  }
});

$("#lesson-list").on("click", '.edit-cours', (e) => {
  const id = e.currentTarget.id;

  findLesson(id, displayModalEditLesson);
});

$("#levels-list").on('click', '.level-edit-btn', e => {
  let levelId = e.currentTarget.attributes['id'].value;

  var selectedLevel = levelList.find(item => levelId == item.id);

  $('input[name="edit-level-name"]').val(selectedLevel.name);
  $('input[name="id-edited-level"]').val(selectedLevel.id);

  $("#modal-edit-level").modal('show');
});

$("#btn-modal-create-user").on('click', () => {
  $("#modal-create-user").modal("show");
});

$("#form-create-user").on('submit', (e) => {
  e.preventDefault();
  alert("ok");
});

$("#btn-new-edit-party").on('click',()=>{
  let sectionTemplate = `<div class="two fields">
      <div class="field">
          <input name="edit-parties[]" type="text" placeholder="Nom de la Section">
      </div>
      <div class="field">
          <input min="0" name="edit-pages[]" placeholder="Numero Page" type="number">
      </div>
  </div>`;

  $("#edit-parties").append(sectionTemplate);
});

$("#form-edit-lesson").on('submit',(e)=>{
  e.preventDefault();

  e.currentTarget.classList.add("loading", "disabled");
  
  var parties = $("input[name='edit-parties[]']").map(function () {
    return $(this).val()
  }).get();

  var pages = $("input[name='edit-pages[]']").map(function () {
    return $(this).val() ?? $(this).val();
  }).get();

  var lessonId = $("input[name='id-edited-course'] ").val();
  var doc = $("input[name='doc']")[0].files[0];
  var formData = new FormData();

  formData.append('lesson-name', $("input[name='lesson-edit-name']").val());
  formData.append('lesson-description', $("textarea[name='lesson-edit-description']").val());
  formData.append('lesson-level', $("select[name='level']").val());
  formData.append('lesson-parties', parties);
  formData.append('section-pages', pages);
  formData.append('type', 'pdf');
  formData.append('doc', doc);

  editLesson(formData, lessonId);
});

function displayLessons(lessons) {
  $("#lesson-list").empty();
  $("#lesson-message").hide();

  if (lessons.length > 0) {
    lessons.forEach((lesson) => {

      let level = levelList.find(item => lesson.id_level == item.id);

      $("#lesson-list").append(createLessonTemplate(lesson, level));
    });
  } else {
    $("#lesson-message").show();
  }
}

function displayModalEditLesson(data) {
  $("input[name='lesson-edit-name']").val(data.lesson.name);
  $("textarea[name='lesson-edit-description']").val(data.lesson.desc);
  $("input[name='id-edited-course']").val(data.lesson.id);
  $("select[name=level]").empty();

  levelList.forEach(item => {
    let option = `<option value=${item.id}>${item.name}</option>`

    if (item.id == data.lesson.id_level) {
      option = `<option value=${item.id} selected>${item.name}</option>`
    }

    $("#edit-parties").empty();
    data.sections.forEach(sectionItem => {
      let sectionTemplate = `<div class="two fields">
        <div class="field">
            <input name="edit-parties[]" type="text" value="${sectionItem.name}" placeholder="Nom de la Section">
        </div>
        <div class="field">
            <input min="0" name="edit-pages[]"  value="${sectionItem.page}" placeholder="Numero Page" type="number">
        </div>
      </div>`;

      $("#edit-parties").append(sectionTemplate);
    });

    $("select[name=level]").append(option);
  });

  $("#edit-cours").modal("show");
}

$("#form-edit-lesson").on('submit',(e)=>{
  e.preventDefault();
  alert("ok");
});

function showPanel(panelName) {
  panels.forEach(pa => { pa[0].id == panelName[0].id ? panelName.show() : pa.hide() });
}

function displayLevels() {
  $("#levels-list").empty();

  levelList.forEach(level => $("#levels-list").append(createTableTemplateForLevelItem(level)));
}

function showDetailCours(courseId, courseName) {
  $("#course-name").text(courseName);

  $("#course-id").val(courseId);

  getLesson(courseId, displayLessons);

  showPanel(panelDetailCours);
}

function setLevel(data) {
  levelList = data;
}

function getUsers() {
  $.getJSON('/users').done(response => {
    response.forEach(element => {
      let template = `<div class="item">
            <img class="ui tiny image" src="/images/${element.role == 'EDITEUR' ? 'editeur.png' : 'admin.png'}">
            <div class="content">
                <h3 class="header">${element.username}</h3>
                Rôle :<strong> ${element.role == 'EDITEUR' ? 'Editeur' : 'ADMIN'}</strong>
            </div>
        </div>`;

      $("#users-list").append(template);
    });
  }).fail(error => {
    alert("Une erreur s'est produite au niveau du serveur");
    console.log(error);
  })
}
