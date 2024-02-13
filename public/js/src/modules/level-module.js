export var levelList = [];

export function getLevels(callback) {
  $.getJSON('/level/').done(response => {
    levelList = response;
    callback(response)
  }).fail(error => {
    console.log(error)
  })
}

export function addLevelToForm() {
  $("select[name='level']").empty();

  levelList.forEach((item, i) => {
    var option = `<option value="${item.id}">${item.name}</option>`

    $("select[name='level']").append(option)
  });
}

export function createLevel() {
  $.post('/level/create', $("#form-create-level").serialize()).done(response => {
    if (response.success) {
      console.log(response)
      alert('Operation Reussie')
    }
  }).fail(error => {
    alert("Une erreur s'est produite au niveau du serveur")
    console.log(error)
  });
}

export function editLevel(id) {
  $.post(`/level/${id}/update`, $("#form-edit-level").serialize()).done(response => {
    if (response.success) {
      alert("Modification enregistrée");
      $("#modal-edit-level").modal('hide');
    }
  }).fail(error => {
    alert("Une erreur s'est produite au niveau du serveur")
    console.log(error)
  })
}
