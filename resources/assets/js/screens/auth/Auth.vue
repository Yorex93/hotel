<template>
    <div class="box">
        <h1>Login</h1>
        <div class="form">
            <form>
                <span class="has-error" v-if="errors.authentication">{{ errors.authentication }}</span>
                <label>Username</label>
                <input type="text" placeholder="Enter your username" v-model="model.username">
                <label>Password</label>
                <input type="password" placeholder="Enter your password" v-model="model.password">
                <a href="#">Forgot password?</a>
                <button @click.prevent="login()">Login</button>
            </form>

        </div>
    </div>
</template>

<script>
    import { mapGetters, mapMutations, mapActions } from 'vuex'
    export default {
        name: 'Auth',
        data: () => ({
            model: {
                username: '',
                password: ''
            },
            errors: {
                username: '',
                password: '',
                authentication: ''
            }
        }),
        methods: {
            ...mapActions({ userLogin : 'user/login'}),
            onSuccess(data){
                this.$store.commit('setAuth', data);
                this.$router.replace('/admin/dashboard');
            },
            login(){
                this.errors.authentication = '';
                this.userLogin({ email: this.model.username, password: this.model.password , router: this.$router}).then((response) => {

                }).catch(error => {
                    console.log(error.response);
                    this.errors.authentication = `Username/password incorrect`;
                });
            }
        },
        computed: {
            ...mapGetters('user', ['isLoggedIn', 'attemptingLogin']),
        }
    }
</script>

<style lang="scss">
    body {
        background-size: cover;
        background: linear-gradient(45deg, #3700ff, #b200ff) no-repeat;
        height: 100vh;
        overflow: hidden;
        margin: 0 !important;
    }

    .box {
        background: #ffffff;
        width: 400px;
        margin: 100px auto;
        border-radius: 8px;
        padding: 40px 30px;

        @media screen and (max-width: 360px){
            width: 320px;
        }
    }

    .box h1 {
        font-size: 28px;
        font-weight: 700;
        text-align: center;
    }

    .box .form {
        padding: 30px 0;
    }

    .box label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        padding: 0;
    }

    .box input[type=text],
    .box input[type=password] {
        width: 100%;
        border: 0;
        padding: 10px 0 ;
        font-size: 14px;
        font-weight: 500;
        box-shadow: inset 0 -1px  #b3b3b3;
        margin-bottom: 20px;
        outline-color: transparent;
        transition: all .3s ease;
    }

    .box input[type=text]:hover,
    .box input[type=password]:hover {
        outline: none;
    }

    .box input[type=text]:focus,
    .box input[type=password]:focus {
        outline: none;
    }

    .box a {
        display: block;
        width: 100%;
        text-align: right;
        font-size: 12px;
        margin-bottom: 20px;
    }

    .box button {
        display: block;
        width: 100%;
        background: #b200ff linear-gradient(45deg, rgba(55, 0, 255, .8), rgba(178, 0, 255, .8));
        padding: 10px 20px;
        border: 0;
        border-radius: 50px;
        font-weight: 500;
        color: #ffffff;
        transition: all .3s ease;
        outline-color: transparent;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
    }

    .box button:hover {
        background-color: #e09bff;
        box-shadow: 0 5px 25px -5px #b200ff;
        transform: translateY(-1px);
        text-shadow: 0 0 1px rgba(0, 0, 0, 0.5);

    }

    .box button:active {
        background-color: #3e005b;
        box-shadow: 0 3px 10px -2px #b200ff;
        transform: translateY(1px) scale(.99);
        outline: none;
    }

    .box button:focus{
        outline: none;
    }

    span{
        &.has-error{
            color: red;
            display: block;
            text-align: center;
        }
    }
</style>