<template>
    <div>
        <header id="header" class="fixed-top d-flex align-items-center" style="background-color: #1acc8d">
            <div class="container d-flex align-items-center">
                <div class="logo mr-auto">
                    <h1 class="text-danger"><router-link to="/"><span class="text-white">রক্তদিন</span></router-link></h1>
                </div>
                <nav class="nav-menu d-none d-lg-block" v-if="isAuthUserId === true">
                    <ul>
                        <li class="active"><router-link to="/">হোম</router-link></li>
                        <li><a href="#gallery">জিজ্ঞাসা</a></li>
                        <li><router-link to="/contact">যোগাযোগ</router-link></li>
                        <li><router-link to="/donor/profile">{{ this.$userName }}</router-link></li>
                        <li>
                            <a href="#" @click.prevent="logout">Logout</a>
                            <form id="logout-form" action="logout" method="POST" style="display: none;">
                                <input type="hidden" name="_token" :value="csrf">
                            </form>
                        </li>
                    </ul>
                </nav><!-- .nav-menu -->
                <nav class="nav-menu d-none d-lg-block" v-if="isAuthUserId === false">
                    <ul>
                        <li class="active"><router-link to="/">হোম</router-link></li>
                        <li><a href="#gallery">জিজ্ঞাসা</a></li>
                        <li><router-link to="/donor/register">নিবন্ধন</router-link></li>
                        <li><router-link to="/donor/register">লগইন</router-link></li>
                        <li><router-link to="/contact">যোগাযোগ</router-link></li>
                    </ul>
                </nav><!-- .nav-menu -->

            </div>
        </header>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "Master",
    data(){
        return {
            isAuthUserId : this.$authUserId ? true : false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    methods:{
        logout(){
            axios.post('logout').then(response => {
                if (response.status == 204) {
                    this.isAuthUserId = false
                    this.$router.push({name: 'home'}).catch(()=>{})
                }
                else {
                }
            }).catch(error => {
                console.log(error)
            });
        }
    }
}
</script>

<style scoped>

</style>
