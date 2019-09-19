<template>
    <div>
        <form>
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
            <div v-if="errors && errors.address" class="error-messages">
                <h6>{{ errors.address[0] }}</h6>
            </div>
            <div v-if="errors && errors.book_name" class="error-messages">
                <h6>{{ errors.book_name[0] }}</h6>
            </div>
            <div v-if="validation">
                <div v-for="message in validation" v-bind:key="message" class="error-messages">
                    <h6>{{ message }}</h6>
                </div>
            </div>
            <button v-on:click.prevent="post" type="submit" class="btn btn-block btn-primary">Add</button>
        </form>
    </div>
</template>

<script>

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
            errors: null,
            validation: [],
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
        post(){
            this.validateInputs();
            if (this.validation.length) {
                return;
            }

            this.$http.post('api/author-book',
            {
                author_name:this.author.name,
                date_of_birth:this.author.date_of_birth,                
                address:this.author.address,
                book_name:this.book.name,
                release_date:this.book.release_date
            }
            ).then(data => {
                //console.log("hello");
            }, (response) => {
               this.errors = response.body.errors;
            })
                this.author.name ="",
                this.author.date_of_birth ="",                
                this.author.address ="",
                this.book.name ="",
                this.book.release_date =""
            // .catch((error) => {
            //    // console.log(error.response.data);
            //     this.errors.record(error.response.data);
            // })
        },
         validateInputs() {
             if (this.book.name) {
                 return true;
             }

              if (!this.book.name) {
                 this.validation.push('Book name required!');
             }
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