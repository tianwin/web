document.addEventListener("DOMContentLoaded", function () {
    const categoriesList = document.getElementById("categories-list");
    const categoryDropdown = document.getElementById("category-dropdown");
    const categoryInput = document.getElementById("category-input");
    const addCategoryBtn = document.getElementById("add-category-btn");

    // Fetch data from server
    function fetchData() {
        fetch("notes_api.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "action=fetchData",
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    categoriesList.innerHTML = "";
                    categoryDropdown.innerHTML = "";
                    data.data.forEach(category => {
                        addCategoryToDOM(category);
                        addCategoryToDropdown(category);
                    });
                }
            });
    }

    // Add category to server
    addCategoryBtn.addEventListener("click", function () {
        const categoryName = categoryInput.value.trim();
        if (!categoryName) return;

        fetch("notes_api.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `action=addCategory&name=${encodeURIComponent(categoryName)}`,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const newCategory = { id: data.id, name: categoryName, notes: [] };
                    addCategoryToDOM(newCategory);
                    addCategoryToDropdown(newCategory);
                    categoryInput.value = "";
                }
            });
    });

    // Add category to the dropdown
    function addCategoryToDropdown(category) {
        const categoryLink = document.createElement("a");
        categoryLink.href = `#category-${category.id}`;
        categoryLink.textContent = category.name;
        categoryDropdown.appendChild(categoryLink);
    }

    // Add category to DOM
    function addCategoryToDOM(category) {
        const categoryContainer = document.createElement("div");
        categoryContainer.className = "category-container";
        categoryContainer.id = `category-${category.id}`;

        const categoryHeader = document.createElement("div");
        categoryHeader.className = "category-header";

        const categoryName = document.createElement("h3");
        categoryName.textContent = category.name;

        const deleteCategoryBtn = document.createElement("button");
        deleteCategoryBtn.textContent = "Delete Category";
        deleteCategoryBtn.className = "delete-btn";
        deleteCategoryBtn.addEventListener("click", function () {
            if (confirm(`Are you sure you want to delete category '${category.name}' and all its notes?`)) {
                fetch("notes_api.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `action=deleteCategory&category_id=${category.id}`,
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            categoriesList.removeChild(categoryContainer);
                            fetchData();
                        }
                    });
            }
        });

        categoryHeader.appendChild(categoryName);
        categoryHeader.appendChild(deleteCategoryBtn);

        const notesList = document.createElement("ul");
        notesList.className = "notes-list";

        category.notes.forEach(note => {
            addNoteToDOM(category.id, note, notesList);
        });

        const noteInput = document.createElement("input");
        noteInput.type = "text";
        noteInput.placeholder = `Add a note to ${category.name}`;
        noteInput.className = "note-input";

        const addNoteBtn = document.createElement("button");
        addNoteBtn.textContent = "Add Note";
        addNoteBtn.className = "add-btn";
        addNoteBtn.addEventListener("click", function () {
            const noteText = noteInput.value.trim();
            if (!noteText) return;

            fetch("notes_api.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `action=addNote&category_id=${category.id}&content=${encodeURIComponent(noteText)}`,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        addNoteToDOM(category.id, { id: data.id, content: noteText }, notesList);
                        noteInput.value = "";
                    }
                });
        });

        categoryContainer.appendChild(categoryHeader);
        categoryContainer.appendChild(notesList);
        categoryContainer.appendChild(noteInput);
        categoryContainer.appendChild(addNoteBtn);
        categoriesList.appendChild(categoryContainer);
    }

    // Add note to DOM
    function addNoteToDOM(categoryId, note, notesList) {
        const noteItem = document.createElement("li");

        const noteContent = document.createElement("span");
        noteContent.textContent = note.content;
        noteContent.contentEditable = "true";

        noteContent.addEventListener("blur", function () {
            fetch("notes_api.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `action=editNote&note_id=${note.id}&content=${encodeURIComponent(noteContent.textContent)}`,
            });
        });

        const deleteNoteBtn = document.createElement("button");
        deleteNoteBtn.textContent = "Delete";
        deleteNoteBtn.className = "delete-btn";
        deleteNoteBtn.addEventListener("click", function () {
            fetch("notes_api.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `action=deleteNote&note_id=${note.id}`,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        notesList.removeChild(noteItem);
                    }
                });
        });

        noteItem.appendChild(noteContent);
        noteItem.appendChild(deleteNoteBtn);
        notesList.appendChild(noteItem);
    }

    fetchData(); // Load data on page load
});
