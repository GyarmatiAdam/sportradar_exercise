<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Authors with books</h3><br> 
                <button @click="showData()">Show/Hide data</button>
                <div v-if="displayData">      
                    <div class="card" v-for="author in authors" v-bind:key="author.id">
                        <div class="card-body">
                            <h1 class="card-title">
                                <small>Name:{{ author.name }} </small> 
                                
                                <small>
                                    (Address: {{author.address}})
                                    (age:{{ author.age }})
                                </small>
                            </h1>
                            <div class="card" v-for="book in author.books" v-bind:key="book.id">
                                <p class="card-body"> 
                                    <small>Title: </small>
                                    {{ book.name }}
                                </p>
                                <small>(Released at: {{ book.release_date }})</small>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            authors: [],
            author: {
                id: '',
                name: '',
                age: '',
                address: '',
                books: [],
                book: {
                    id: '',
                    name: '',
                    release_date: '',
                    authors_id: ''
                },
            },
            author_id: '',
            displayData: false
        };
    },

    created() {
        this.fetchAuthorsWithBooks();
    },

    methods: {
        showData() {
            this.displayData = !this.displayData;
        },
        fetchAuthorsWithBooks() {
            fetch('api/authors-books')
            .then(res => res.json())
            .then(res => {
                this.authors = res;
            });
        }
    }
};
</script>