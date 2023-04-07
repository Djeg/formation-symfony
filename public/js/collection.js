/**
 * Petit fichier javascript permettant de gérer les collection
 * dans nos formulaires
 */
document.addEventListener("DOMContentLoaded", () => {
  // Ici, le javascript s'éxécutera seulement lorsque tout le html est chargé

  // On séléctionne les input de collection
  const collections = document.querySelectorAll(".collection");

  // on créer un bouton plus, pour chaque collection
  for (let collection of collections) {
    const plus = document.createElement("button");
    plus.setAttribute("type", "button");
    plus.innerHTML = `<i class="fa-solid fa-circle-plus"></i>`;

    collection.appendChild(plus);

    plus.addEventListener("click", (e) => {
      e.preventDefault();
      // Je compte le nombre d'entrées
      let id = 0;
      if (document.querySelectorAll(".entry").length) {
        const lastId = parseFloat(
          document.querySelector('[data-class="entry"]:last-of-type').dataset.id
        );
        id = lastId + 1;
      }
      // Je séléctionne le data-protype de la colelction
      const html = collection.dataset.prototype.replaceAll("__name__", "");
      const div = document.createElement("div");
      div.innerHTML = html;
      const el = div.firstChild;
      el.dataset.id = id;
      el.dataset.class = "entry";
      collection.append(el);

      // Création du bouton de suppression
      const remove = document.createElement("button");
      remove.innerHTML = `<i class="fa-solid fa-trash"></i>`;
      remove.setAttribute("type", "button");

      remove.addEventListener("click", (e) => {
        e.preventDefault();
        el.remove();
      });

      el.append(remove);
    });

    document.querySelectorAll('[data-class="entry"]').forEach((el) => {
      const remove = document.createElement("button");
      remove.innerHTML = `<i class="fa-solid fa-trash"></i>`;
      remove.setAttribute("type", "button");

      remove.addEventListener("click", (e) => {
        e.preventDefault();
        el.remove();
      });

      el.append(remove);
    });
  }
});
