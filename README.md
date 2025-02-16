# To Do List Alpine
To Do List Alpine is a basic sample app created with Alpine.js.

![imagen](https://github.com/user-attachments/assets/32b1654a-74b5-4f05-8ea1-ef5c57ce0d20)

This sample uses Alpine.js v3 to create a simple To Do List App using the browser LocalStorage or a basic PHP API created with FlexCore Functions.

The app will show a main view with a text input to create new tasks, a list of the created tasks with a done checkbox, an editable text input and a delete button.

At the bottom of the to do list, the app has a group of buttons to configure the mode: Local or API.

The selected mode is saved in the browser LocalStorage, so the app will remember this selection next time the app is loaded.

This is my first app created with Alpine.js and was really fun to create it while learning the main concepts of this awesome and lightweight JavaScript framework.

## How to run

It works by downloading the project files and opening the file `todolist.html` in any browser, but you can only use the Local mode. 

If the project is open from a local server with Apache2/PHP7+, you can run the API mode. Then the to do list data is fetch and saved using the API and the backend store al todos into a JSON file in `api/data` folder.

## References

- [Alpine.js](https://alpinejs.dev/)
- FlexCore Functions



