
/**
 * ToDosListAlpine JS - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok
 * 
 * @api "api/get.php"
 * @api "api/save.php"
 */

(function() {

	async function http_request(method, url, data) {
		var config = (method == 'POST') 
			? {
				method: "POST",
				body: new URLSearchParams(data)
			} 
			: {};
		var response = await fetch(url, config);
		if (!response.ok) {
			throw new Error('ERROR: Unable to connect to server.');
		}
		var result = await response.json();
		if (result.err) {
			throw new Error(result.msg);
		}
		return result;		
	} 

	async function http_get(url) {
		return await http_request('GET', url);
	}

	async function http_post(url, data) {
		return await http_request('POST', url, data);
	}

	async function fetchTodos() {
		console.log('Loading ToDos data...');
		var result = await http_get('api/get.php');
		console.log(result.data);
		return result.data;
	}

	async function saveTodos(todos) {
		console.log('Saving ToDos data...');
		var result = await http_post('api/save.php', {todos: JSON.stringify(todos)});
		console.log(result.msg);
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
				this.$watch('todos', async () => {
					try {
						await saveTodos(this.todos);
					} catch(e) {
						console.log(e.message);
					}
				});
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
