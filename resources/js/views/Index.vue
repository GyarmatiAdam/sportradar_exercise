<template>
    <div>
        <form @submit.prevent="addAuthor">
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
            <button type="submit" class="btn btn-block btn-primary">Add</button>
        </form>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Authors</h3><br>       
                    <nav id="authors">
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#authors" @click="fetchAuthors(pagination.prev_page_url)">Previous</a>
                            </li>
                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#authors" @click="fetchAuthors(pagination.next_page_url)">Next</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="card" v-for="author in authors" v-bind:key="author.id">
                        <div class="card-body">
                            <h5 class="card-title">{{ author.name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ author.date_of_birth }}</h6>
                            <p class="card-text">{{ author.address }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h3>Books</h3><br>
                    <nav id="books">
                        <ul class="pagination">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                <a class="page-link" href="#books" @click="fetchBooks(pagination.prev_page_url)">Previous</a>
                            </li>
                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                <a class="page-link" href="#books" @click="fetchBooks(pagination.next_page_url)">Next</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="card" v-for="book in books" v-bind:key="book.id">
                        <div class="card-body">
                            <h5 class="card-title">{{ book.name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ book.release_date }}</h6>
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
                address: ''
            },
            author_id: '',
            pagination: {},
            edit: false
        };
        return {
            books: [],
            book: {
                id: '',
                name: '',
                release_date: '',
                authors_id: ''
            },
            book_id: '',
            pagination: {},
            edit: false
        };
    },

    created() {
        this.fetchAuthors();
        this.fetchBooks();
    },

    methods: {
        fetchAuthors(page_url) {
            let vm =this;
            page_url = page_url || 'api/authors'
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                this.authors = res.data;
                vm.makepagination(res.data, res.links);
            })
            .catch(err => console.log(err));
        },
        fetchBooks(page_url) {
            let vm =this;
            page_url = page_url || 'api/books'
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                this.books = res.data;
                vm.makepagination(res.data, res.links);
            })
            .catch(err => console.log(err));
        },
        makepagination(meta, links) {
            let pagination = {
                next_page_url: links.next,
                prev_page_url: links.prev
            };

            this.pagination = pagination;
        },
        addAuthor() {
                fetch('api/author', {
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
                    alert('Author added');
                    this.fetchAuthors();
                })
                .catch(err => alert(err));
        },
        addBook() {
            fetch('api/book', {
                method: 'post',
                body: JSON.stringify(this.book),
                headers: {
                    'content-type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                this.book.name = '';
                this.book.release_date = '';
                this.book.authors_id = '';
                alert('Book added');
                this.fetchBooks();
            })
            .catch(err => alert(err));
        }
    }
};
</script>