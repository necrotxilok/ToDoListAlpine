(function() {

	async function fetchTodos() {
		console.log('loading...');
		var response = await fetch('data/todos.json');
		if (!response.ok) {
			throw new Error('Unable to get todos from server.');
		}
		var todos = await response.json();
		console.log(todos);
		return todos;
	}

	window.todoList = function() {
		return {
			loaded: false,
			todos: [],
			newTodo: "",
			error: "",
			async init() {
				try {
					this.todos = await fetchTodos();
					this.loaded = true;
				} catch(e) {
					console.log(e.message);
					this.error = e.message;
				}
			},
			addTodo(text) { 
				this.todos.push({
					done: false,
					text: text
				});
				this.newTodo = '';
			},
			delTodo(index) {
				this.todos.splice(index, 1);
			},
		}
	}

})();
