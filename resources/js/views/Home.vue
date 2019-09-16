<template>
    <div>
        <div>
            <h3>Author:</h3>
            <label>Author´s name</label>
            <input type="text"><br>
            <label>Date of borth</label>
            <input type="text"><br>
            <label>Address</label>
            <input type="text"><br>
            <h3>Book:</h3>
            <label>Book´s name</label>
            <input type="text"><br>
            <label>Release date</label>
            <input type="text"><br>
            <input type="button" value="Add">
        </div>
        <h3>Data:</h3>
        <div v-for="author in authors" v-bind:key="author.id">
            <h6>{{ author.name }}</h6>
            <p>{{ author.address }}</p>
            <p>{{ author.date_of_birth }}</p>
        </div>
        <input type="button" value="Display data">
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
    },

    created() {
        this.fetchAuthors();
    },

    methods: {
        fetchAuthors() {
            fetch('api/authors')
            .then(res => res.json())
            .then(res => {
                this.authors = res.data;
            });
        }
    }
};
</script>