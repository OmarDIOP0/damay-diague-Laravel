
$("input[name='type-support']").change((e) => {
  if (e.currentTarget.value === "pdf") {
    $("#section-items").show();
  } else {
    $("#section-items").hide();
  }
})

$("#btn-new-party").click(() => {
  $("#parties").append(createSectionTemplate());
});

$("#btn-show-modalCC").click(() => {
  $('#modal-create-course').modal('show');
});

$("#btn-load-photo").click(() => {
  $("input[name='course-icon']").trigger("click")
});

$("#btn-load-course").click(() => {
  $("input[name='course-file']").trigger("click")
});

$("input[name='course-icon]").change((e) => {
  var filename = e.target.files[0].name;

  $("#btn-load-photo").text(filename);

  $("#btn-load-photo").addClass("grey")
});

export function createSectionTemplate() {
  return `<div class="two fields">
  <div class="field">
  <input name="parties[]"  type="text" placeholder="Nom de la Section">
  </div>
  <div class="field">
  <input min="0" name="pages[]" placeholder="Numero Page" type="number">
  </div>
  </div>`;
}

export function createLessonTemplate(lesson, level) {

  return `<div class="item">
  <img class="ui mini image" src="/images/write.png">
  <div class="content">
  <div class=" header grey">${lesson.name}<br></div>
  Niveau : ${level.name}
  </div>
  <div class="right floated content">
   <button id="${lesson.id}" class="ui button blue edit-cours ${lesson.status == 1 ? "disabled":""}" >Modifier</button>
  <a id="${lesson.id}" status=${lesson.status} class="ui button ${lesson.status == 0 ? "green" : "red"} btn-publish">${lesson.status == 0 ? "Publier" : "Ne pas publier"}</a>
  </div>
  </div>`;
}

export function createTableTemplateForLevelItem(level) {
  return `<div class="item">
    <div class="right floated content">
      <div class="ui button green basic level-edit-btn" id=${level.id} name="${level.name}">
        Modifier
      </div>
      <div class="ui button red basic detail" id=${level.id} name="${level.name}">
        Supprimer
      </div>
    </div>
    <img class="ui mini image" src="images/file.png" name="${level.name}" >
    <div class="content">
      ${level.name}
    </div>
  </div>`;
}

export function createListTemplateForLevelItem(level, checked) {
  return `
  <div class="item">
  <div class="right floated content">
  <div class="ui button basic " >
  <input type="checkbox" class="level-item" value=${level.id} ${checked ? 'checked' : ''}>
  </div>
  </div>
  <div class="content">
  ${level.name}
  </div>
  </div>`;
}

export function getLessonItemView(lesson) {
  let level = lesson.course.levels.find(item => item.id == lesson.id_level);

  return `<div class="row ui raised segment lesson-item">
  <div class="two wide column lesson-item-img" >
  <img src="/images/${lesson.course.slug}-icon.jpg" class="image"  alt="">
  </div>
  <div class="lesson-details ten wide column">
  <span class="bold">${lesson.course.name}</span><br>
  <a class="bold" href=/cours/${lesson.course.slug}/${lesson.slug}>${lesson.name}</a><br>
  <span>Niveau :${level.name}</span><br>
  <span>Description : ${lesson.desc}</span>
  </div>
  </div>`;
}
