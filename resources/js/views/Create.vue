<template>
    <div>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center ">
                        <router-link :to="{ name: 'home' }">HOME</router-link>
                        <router-link :to="{ name: 'create' }">CREATE</router-link>
                    </h1>
                    <div class="card">
                        <div class="card-header text-center mt-5 mb-5">
                        <h3>You can insert new data here</h3><br>
                        </div>
                    </div>
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
                        <!-- back-end validation -->
                        <div v-if="errors && errors.address" class="alert alert-danger">
                            <h6>{{ errors.address[0] }}</h6>
                        </div>
                        <div v-if="errors && errors.author_name" class="alert alert-danger">
                            <h6>{{ errors.author_name[0] }}</h6>
                        </div>
                        <div v-if="errors && errors.date_of_birth" class="alert alert-danger">
                            <h6>{{ errors.date_of_birth[0] }}</h6>
                        </div>
                        <div v-if="errors && errors.book_name" class="alert alert-danger">
                            <h6>{{ errors.book_name[0] }}</h6>
                        </div>
                        <div v-if="errors && errors.release_date" class="alert alert-danger">
                            <h6>{{ errors.release_date[0] }}</h6>
                        </div>
                        <!-- front-end validation -->
                        <div v-if="validation">
                            <div v-for="message in validation" v-bind:key="message" class="alert alert-danger">
                                <h6>{{ message }}</h6>
                            </div>
                        </div>
                        <button v-on:click.prevent="post" type="submit" class="btn btn-block btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
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
                Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Hooray...Success!!!',
                showConfirmButton: false,
                timer: 2600
            })
            }, (response) => {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    showConfirmButton: false,
                    timer: 2600
                })
               this.errors = response.body.errors;
            })
                this.author.name ="",
                this.author.date_of_birth ="",                
                this.author.address ="",
                this.book.name ="",
                this.book.release_date =""
        },
         validateInputs() {
            if (this.book.name) {
                 return true;
            }else{
                 this.validation.push('Please enter book name!');
            }
            if (this.book.release_date) {
                 return true;
            }else{
                 this.validation.push('Please enter release date!');
            }
            if (this.author.name) {
                 return true;
            }else{
                 this.validation.push('Please enter author name!');
            }
            if (this.book.address) {
                 return true;
            }else{
                 this.validation.push('Please enter address!');
            }
            if (this.book.date_of_birth) {
                 return true;
            }else{
                 this.validation.push('Please enter date of birth!');
            }
        }
    }
}
</script>