export let courses = [];

export function getCourses(callback) {
  $.getJSON("/courses").done(data => {
    callback(data);
  }).fail(error => {
    $("#loader").hide();
    alert("Une erreur s'est produite au niveau du serveur")
  })
}

export function displayCourses(coursesList) {
  courses = coursesList;

  $("#list-cours").empty();

  courses.forEach(c => {
    var item = `
    <div class="item">
    <div class="right floated content">
    <div class="ui button orange basic detail" data-usage=${c.id} name="${c.name}">
    Voir
    </div>
    </div>
    <img class="ui mini image" src="/storage/app/public/images/${c.icon}" name="${c.name}" >
    <div class="content">
    ${c.name}
    </div>
    </div>`;

    $("#list-cours").append(item);
  });
}

export function addCourseDataToEditForm() {
  let courseId = $("#course-id").val();

  $("input[name='id-edited-course']").val(courseId);

  let selectedCourse = courses.find(c => c.id == courseId);

  $("#course-levels").empty();

  selectedCourse.levels.forEach((item, i) => {
    let e = `<a class="ui black label">${item.name}</a>`;
    $("#course-levels").append(e);
  });

  $("input[name='edit-course-name']").val(selectedCourse.name);
  $("textarea[name='edit-description']").val(selectedCourse.desc);

  return selectedCourse;
}

export function createCourse() {
  var courseName = $("input[name='course-name']").val();
  var courseIcon = $("input[name='course-icon']")[0].files[0];
  var courseDescription = $("textarea[name='description']").val();

  var formData = new FormData();
  formData.append("course-name", courseName);
  formData.append("icon", courseIcon);
  formData.append("description", courseDescription);

  $.ajax({
    url: '/course/create',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: () => {
      alert("Cours créé avec success");
      $('#modal-add-lesson').modal('hide');
    },
    fail: error => {
      alert("Une erreur s'est produite au niveau du serveur")
      console.log(error);
    }
  })
}

export function editCourse() {
  let idCourse = $("input[name='id-edited-course']").val();

  $.post(`/course/${idCourse}/update`, $("#form-edit-course").serialize()).done(response => {
    if (response.success) {
      for (var course in courses) {
        if (course.id == idCourse) {
          course.name = $("input['name=edit-course-name']").val();
          course.desc = $("textarea['name=edit-description']").val();
          // TODO definir une methode async pour mettre à jour les datas
          //showDetailCours(idCourse, $("input['name=edit-course-name']").val())
          break;
        }
      }
      alert("Modification Enregistrée");
      $('#modal-edit-course').modal('hide');

    } else {
      alert("Une erreur s'est produite au niveau du serveur");
    }
  }).fail(error => {
    alert("Une erreur s'est produite au niveau du serveur");
    console.log(error)
  })
}
