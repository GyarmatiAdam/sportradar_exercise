<template>
    <div>
        <form @submit.prevent="addAuthorWithBook">
            <div class="form-group">
                <label>Author's Name</label>
                <input v-model="author.name" type="text" class="form-control" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label>Author's birthday</label>
                <input v-model="author.date_of_birth" type="date" class="form-control">
            </div>
            <div class="form-group">
                <label>Author's address</label>
                <input v-model="author.address" type="text" class="form-control" placeholder="Enter address">
            </div>
             <div class="form-group">
                <label>Book's name</label>
                <input v-model="author.book.name" type="text" class="form-control" placeholder="Enter book's name">
            </div>
            <div class="form-group">
                <label>Release date</label>
                <input v-model="author.book.release_date" type="date" class="form-control">
            </div>
            <button type="submit" class="btn btn-block btn-primary">Add</button>
        </form>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Authors with books</h3><br>       
                    <div class="card" v-for="author in authors" v-bind:key="author.id">
                        <div class="card-body">
                            <label>Author's name: </label>
                            <h1 class="card-title">{{ author.name }}</h1>
                            <label>Book title:</label>
                            <div class="card" v-for="book in author.books" v-bind:key="book.id">
                                <p class="card-body">{{ book.name }}</p>
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
                date_of_birth: '',
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
        };
    },

    created() {
        this.fetchAuthorsWithBooks();
    },

    methods: {
        fetchAuthorsWithBooks() {
            fetch('api/authors-books')
            .then(res => res.json())
            .then(res => {
                this.authors = res;
            });
        },
        addAuthorWithBook() {
                fetch('api/author-book', {
                    method: 'post',
                    body: JSON.stringify(this.author),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.author.name = '';
                    this.author.date_of_birth = '';
                    this.author.address = '';
                    this.author.book.name = '';
                    this.author.book.release_date = '';
                    alert('Author with book added');
                    this.fetchAuthorsWithBooks();
                })
                .catch(err => console.log(err));
        }
    }
};
</script>