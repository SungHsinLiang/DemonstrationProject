<template>
  <div class="container">
    {{ $options.name }}
    <Header />
    <AddTodo v-on:add-todo="addTodo" />
    <div v-for="todo in todos" :key="todo.id">
      <!-- <h3>{{ todo }}</h3> -->
      <TestItem v-bind:todo="todo" v-on:del-todo="deleteTodo" />
    </div>
  </div>
</template>

<script>
import TestItem from "./TestItem.vue";
import Header from "./Header.vue";
import AddTodo from "./AddTodo.vue";

export default {
  name: "test_vue",

  components: {
    Header,
    TestItem,
    AddTodo
  },

  mounted() {
    console.log("Component mounted.");
  },

  data() {
    return {
      todos: [
        // {
        //   id: 1,
        //   title: "Todo_one",
        //   completed: false
        // },
        // {
        //   id: 2,
        //   title: "Todo_two",
        //   completed: false
        // },
        // {
        //   id: 3,
        //   title: "Todo_three",
        //   completed: true
        // }
      ]
    };
  },
  methods: {
    deleteTodo(id) {
      axios
        .delete(`https://jsonplaceholder.typicode.com/todos/${id}`)
        .then(res => this.todos = this.todos.filter(todo => todo.id !== id))
        .catch(err => console.log(err));

      // this.todos = this.todos.filter(todo => todo.id !== id);
    },
    addTodo(newTodo) {
      const { title, completed } = newTodo;

      axios
        .post("https://jsonplaceholder.typicode.com/todos", {
          title,
          completed
        })
        .then(res => this.todos = [...this.todos, res.data])
        .catch(err => console.log(err));

      // this.todos = [...this.todos, newTodo];
    }
  },
  created() {
    axios
      .get("https://jsonplaceholder.typicode.com/todos?_limit=5")
      .then(res => this.todos = res.data)
      .catch(err => console.log(err));
  }
};
</script>

<style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  line-height: 1.4;
}
.btn {
  display: inline-block;
  border: none;
  background: #555;
  color: #fff;
  padding: 7px 20px;
  cursor: pointer;
}
.btn:hover {
  background: #666;
}
</style>