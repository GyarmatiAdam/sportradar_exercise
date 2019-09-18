<template>
    <div>
        <form @submit.prevent="validateInputs" action="/" method="post">
            <div class="form-group">
                <label>Author's Name</label>
                <input id="aut_name" name="aut_name" v-model="author.name" type="text" class="form-control" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label>Author's birthday</label>
                <input id="aut_birth" name="aut_birth" v-model="author.date_of_birth" type="date" class="form-control">
            </div>
            <div class="form-group">
                <label>Author's address</label>
                <input id="aut_addr" name="aut_addr" v-model="author.address" type="text" class="form-control" placeholder="Enter address">
            </div>
             <div class="form-group">
                <label>Book's name</label>
                <input id="book_name" name="book_name" v-model="book.name" type="text" class="form-control" placeholder="Enter book's name">
            </div>
            <div class="form-group">
                <label>Release date</label>
                <input id="book_date" name="book_date" v-model="book.release_date" type="date" class="form-control">
            </div>
            <div class="error-messages">
            {{ errors.get('address') }}
            </div>
            <button v-on:click.prevent="post" type="submit" class="btn btn-block btn-primary">Add</button>
            <!-- <p v-if="errors && errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
                </ul>
            </p> -->
        </form>
        <h1>{{ author.name }}</h1>
        <h1>{{ author.date_of_birth }}</h1>
        <h1>{{ author.address }}</h1>
        <h1>{{ book.name }}</h1>
        <h1>{{ book.release_date }}</h1>
    </div>
</template>

<script>

class Errors{
    constructor(){
        this.errors = {};
    }

    get(field){
        if(this.errors[field]){
            return this.errors[field][0];
        }
    }

    record(errors){
        this.errors = errors.errors;
    }
}

export default {
    data(){
        return {
           author:{ 
               name:"", 
               date_of_birth:"", 
               address:"" 
            }, 
            book:{ 
                name:"",
                release_date:""
            },
            errors: new Errors()
            //errors: [],
            // error:{
            //     aut_name: null,
            //     aut_birth: null,
            //     aut_addr: null,
            //     book_name: null,
            //     book_date: null 
            // }
        }
    },

    methods:{
        post:function(){
            this.$http.post('api/author-book',{
                    author_name:this.author.name,
                    date_of_birth:this.author.date_of_birth,                
                    address:this.author.address,
                    book_name:this.book.name,
                    release_date:this.book.release_date

            }).then(function(data){
                console.log(data);
            })
                this.author.name ="",
                this.author.date_of_birth ="",                
                this.author.address ="",
                this.book.name ="",
                this.book.release_date =""
            .catch(error => this.errors.record(error.response.data));
        },
         validateInputs: function (e) {
        //     if (this.aut_name && this.aut_birth && 
        //         this.aut_addr && this.book_name && 
        //         this.book_date)
        //     {
        //         return true;
        //     }

        //     this.errors = [];

        //     if (!this.aut_name) {
        //         this.errors.push('Author name required.');
        //     }
        //     if (!this.aut_birth) {
        //         this.errors.push('Date of birth required.');
        //     }
        //     if (!this.aut_addr) {
        //         this.errors.push('Address required.');
        //     }
        //     if (!this.book_name) {
        //         this.errors.push('Book name required.');
        //     }
        //     if (!this.book_date) {
        //         this.errors.push('Release date required.');
        //     }

        //     e.preventDefault();
        }
    }
}
</script>