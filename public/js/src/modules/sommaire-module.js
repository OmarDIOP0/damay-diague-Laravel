document.addEventListener('DOMContentLoaded', function () {
    const sommairesContainer = document.getElementById('sommaires-container');
    const ajouterSommaireButton = document.getElementById('ajouter-sommaire');
    let sommaireCounter = 1;

        ajouterSommaireButton.addEventListener('click', function () {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${sommaireCounter}</td>
                <td><input type="text" name="sommaires[]" placeholder="Libellé du sommaire"></td>
                <td><input type="number" name="page_num[]" placeholder="Numéro de pages"></td>
                <td><button type="button" class="ui inverted red button supprimer-sommaire">Supprimer</button></td>
            `;

            sommairesContainer.appendChild(newRow);
            sommaireCounter++;

            // Gestion de la suppression de sommaire
            const supprimerSommaireButtons = document.querySelectorAll('.supprimer-sommaire');
            supprimerSommaireButtons.forEach(button => {
                button.addEventListener('click', function () {
                    sommairesContainer.removeChild(newRow);
                });
            });
        });
    });



