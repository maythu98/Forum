<template>
    <div class="w-75">
        <h1>Register</h1>
        <form  ref="registerForm" v-on:submit.prevent>
            <div class="form-group">
                <label for="userName">Your name</label>
                <input type="text" name="name" class="form-control" id="userName" aria-describedby="userName">
                <small id="userName" class="form-text text-muted"> This name will be displayed in public. </small>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
        
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <div class="form-group">
                <label for="passwordConfirmation">Confirm your password</label>
                <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation">
            </div>
            
            <button type="submit" class="btn btn-primary btn-block" @click="registerUser()">Register</button>
            
        </form>

        <div class="row">
            <p>Already registered? </p>
            <router-link to="/login">Log in</router-link>
        </div>
    </div>
</template>

<script>
export default {

    methods: {
        registerUser() {
            
            const formData = new FormData(this.$refs['registerForm']); 
            const data = {};
            
            for (let [key, val] of formData.entries()) {
                Object.assign(data, { [key]: val })
            }

            
            axios.post('/api/register', data).then(response=> {
                const responseData = response.data.registeredEmail;
                console.log(responseData);
                
                this.$router.push({ name: 'login', params: { registeredEmail: responseData } });

            });		

            
        }
    }
}
</script>
