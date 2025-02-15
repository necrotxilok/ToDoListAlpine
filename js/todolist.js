
/**
 * ToDoListAlpine JS - v1.0
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

	async function getTodos() {
		console.log('Loading API data...');
		var result = await http_get('api/get.php');
		console.log(result.data);
		return result.data;
	}

	async function saveTodos(todos) {
		console.log('Saving API data...');
		var result = await http_post('api/save.php', {todos: JSON.stringify(todos)});
		console.log(result.msg);
	}

	function getLocalTodos() {
		console.log('Loading local data...');
		var todos = JSON.parse(localStorage.getItem('ToDoListAlpineData') || '[]');
		console.log(todos);
		return todos;
	}

	function saveLocalTodos(todos) {
		console.log('Saving local data...');
		localStorage.setItem('ToDoListAlpineData', JSON.stringify(todos));
		console.log('OK');		
	}

	window.todoList = function() {
		return {
			offline: true,
			loaded: false,
			todos: [],
			newTodo: "",
			error: "",
			async init() {
				var offline = localStorage.getItem('ToDoListAlpineOffline');
				if (offline) {
					this.offline = offline == 'on';
				}
				await this.load();
				this.$watch('todos', async () => {
					if (this.offline) {
						saveLocalTodos(this.todos);
					} else {
						try {
							await saveTodos(this.todos);
						} catch(e) {
							console.log(e.message);
						}
					}
				});
			},
			async load() {
				document.querySelector('#app').scrollTo(0,0);
				console.log('MODE: ' + (this.offline ? 'Local' : 'API'));
				if (this.offline) {
					this.todos = getLocalTodos();
					this.loaded = true;
				} else {
					try {
						this.todos = await getTodos();
						this.loaded = true;
					} catch(e) {
						console.log(e.message);
						this.error = e.message;
					}
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
			setOffline(offline) {
				if (offline == this.offline) {
					return;
				}
				this.offline = offline;
				localStorage.setItem('ToDoListAlpineOffline', offline ? 'on' : 'off');
				this.loaded = false;
				this.load();
			}
		}
	}

})();
