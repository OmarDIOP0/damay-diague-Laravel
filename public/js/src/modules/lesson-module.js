export var lessonList = [];

export function getLesson(courseId, callback) {
  $.getJSON(`/course/${courseId}/lesson/all`).done(response => {
    lessonList = response;
    callback(lessonList)
  }).fail(error => {
    alert("Une erreur s'est produite au niveau du serveur");
  })
}

export function createPDFCourse(formData, courseId) {

  $.ajax({
    url: `/cours/${courseId}/lesson/create`,
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: response => {
      if (response.success) {
        alert("Leçon ajoutée avec succés");
      } else {
        alert("Une erreur s'est produite lors de la creation");
      }
    },
    fail: error => {
      alert("Une  erreur s'est produite lors de l'enregistrement")
    }
  })
}

export function editLesson(formData, lessonId) {

  $.ajax({
    url: `/lesson/${lessonId}/update`,
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: response => {
      if (response.success) {
        alert("Leçon modifiée avec succés");
      } else {
        alert("Une erreur s'est produite lors de la modification.");
      }
    },
    fail: error => {
      alert("Une  erreur s'est produite lors de la modification")
    }
  })
}

function createHTMLCourse(formData) {
  var courseId = $("#course-id").val();
  var doc = $("input[name='doc']")[0].files[0];
  formData.append('doc', doc);
  formData.append('type', 'html');

  $.ajax({
    url: `/cours/${courseId}/lesson/create`,
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: response => {
      if (response.success) {
        alert("Leçon ajoutée avec succés")
        Location.reload(true);
      } else {
        alert("Une erreur s'est produite lors de la creation du cours");
        console.error(response.error)
      }
    },
    fail: error => {
      alert("Une erreur lors de l'enregistrement du chapitre")
      console.error(error);
    }
  })
}

export function getAllLessons(callback) {
  $.get("/lessons").done(response => {
    callback(response);
  }).fail(error => {
    console.log(error)
  })
}

export function findLesson(id, callback) {
  $.getJSON(`/lessons/${id}/details`).done(response=>{
    if(response.auth){
      callback(response.data)
    }else{
      window.location.href = "/user-login";
    }
  }).fail(error => {
    console.log(error);
  })
}

export function createLesson() {
  var courseId = $("#course-id").val();

  var formData = new FormData()

  formData.append('lesson-name', $("input[name='lesson-name']").val());
  formData.append('lesson-description', $("textarea[name='lesson-description']").val());
  formData.append('lesson-level', $("select[name='level']").val())

  $.ajax({
    url: `/cours/${courseId}/lesson/create`,
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: response => {
      if (response.success) {
        alert("Leçon ajoutée avec succés")
        //window.location.reload(true);
      } else {
        alert("Une erreur s'est produite lors de la creation du cours");
        console.error(response.error)
      }
    },
    fail: error => {
      alert("Une erreur lors de l'enregistrement du chapitre")
      console.error(error);
    }
  })
}

export function edit(lessonId,data){
  var formData = new FormData()

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

  $.ajax({
    url: `/lesson/${courseId}/update`,
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: response => {
      if (response.success) {
        alert("Leçon ajoutée avec succés")
        window.location.reload(true);
      } else {
        alert("Une erreur s'est produite lors de la creation du cours");
        console.error(response.error)
      }
    },
    fail: error => {
      alert("Une erreur lors de l'enregistrement du chapitre")
      console.error(error);
    }
  })
}

export function setLessonStatus(lessonId, status) {
  let result = true;
  $.post(`/lesson/${lessonId}/publish`, {
    'status': status
  }).done(response => {
    if (!response) {
      result = false;
    }
  }).fail(error => {
    alert("Une erreur s'est produite au niveau du serveur");
    result = false;
  })
  return result;
}
