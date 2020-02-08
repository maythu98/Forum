<template>
  <div>
    <h1>login</h1>
    <form ref="logInForm" v-on:submit.prevent>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" :value="registeredEmail" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>

        <button type="submit" class="btn btn-primary btn-block" @click="logInUser()">Register</button>
    </form>
  </div>
</template>

<script>
export default {
    props: ['registeredEmail'],
    methods: {
        logInUser() {
            const formData = new FormData(this.$refs['logInForm']); 
            const data = {};
            
            for (let [key, val] of formData.entries()) {
                Object.assign(data, { [key]: val })
            }

            
            this.$store.dispatch('retrieveToken', data)
                .then(response => {
                    console.log(response);
                  
                    this.$router.push({ path: '/' });  
                })
                .catch(error => {
                console.log(error.response.data);
                })
            
        }
    }
}
</script>
