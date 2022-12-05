new Vue({
    el: '#app',
    data(){
        return{
            email: 'email@email.email',
            password: ''
        };
    },
    computed: {
        isInValidEmail() {
            const regex1 = new RegExp(/^[a-zA-Z0-9_+-]+(\.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/);
            return !regex1.test(this.email);
        },
        isInValidPassword(){
            const regex2 = new RegExp(/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}$/i);
            return !regex2.test(this.password);
        }
    }
})