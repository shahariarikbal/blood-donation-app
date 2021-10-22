<template>
    <div id="app">
        <div class="container register">
            <div class="row">
                <div class="col-md-3 register-left">
                    <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                    <h3>স্বাগতম</h3>
                    <p>রক্তদান একটি মহান কাজ। নিজে রক্ত দিন অন্যকে দিতে উৎসাহিত করুন।</p>
                    <input type="button" name="" value="রক্তদিন"/><br/>
                </div>
                <div class="col-md-9 register-right">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">নিবন্ধন</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">লগইন</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="register-heading">রক্ত দাতা হিসেবে যোগ দিন</h3>
                            <form method="post" name="register_form" @submit.prevent="store()" enctype="multipart/form-data">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" v-model="name" placeholder="আপনার নাম লিখুন *" value="" />
                                            <small class="text-danger" v-if="name_error" style="">{{name_error}}</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" v-model="password" placeholder="পাসওয়ার্ড *" value="" />
                                            <small class="text-danger" v-if="password_error" style="">{{password_error}}</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password_confirmation" v-model="password_confirmation"  placeholder="উপরের পাসওয়ার্ড আবার লিখুন *" value="" />
                                            <small class="text-danger" v-if="password_confirmation_error" style="">{{password_confirmation_error}}</small>
                                        </div>
                                        <div class="form-group">
                                            <div class="maxl">
                                                <label class="radio inline">
                                                    <input type="radio" name="gender" value="male" v-model="gender" checked>
                                                    <span> পুরুষ* </span>
                                                </label>
                                                <label class="radio inline">
                                                    <input type="radio" name="gender" value="female" v-model="gender">
                                                    <span>মহিলা* </span>
                                                </label>
                                                <br/>
                                                <small class="text-danger" v-if="gender_error" style="">{{gender_error}}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" v-model="email" placeholder="আপনার ইমেল" value="" />
                                            <small class="text-danger" v-if="email_error" style="">{{email_error}}</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" minlength="11" maxlength="11" name="phone" v-model="phone" class="form-control" placeholder="আপনার ফোন *" value="" />
                                            <small class="text-danger" v-if="phone_error" style="">{{phone_error}}</small>
                                        </div>
                                        <div class="form-group">
                                            <select name="blood_group" v-model="blood_group" class="form-control">
                                                <option selected disabled value="">আপনার রক্তের গ্রুপ *</option>
                                                <option value="a+">A+</option>
                                                <option value="a-">A-</option>
                                                <option value="b+">B+</option>
                                                <option value="b-">B-</option>
                                                <option value="ab+">AB+</option>
                                                <option value="ab-">AB-</option>
                                                <option value="o+">O+</option>
                                                <option value="o-">O-</option>
                                            </select>
                                            <!--                                            <input type="text" class="form-control" name="blood_group" v-model="blood_group" placeholder="আপনার রক্তের গ্রুপ *" value="" />-->
                                            <small class="text-danger" v-if="blood_group_error" style="">{{blood_group_error}}</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="avatar" id="avatar" @change="expertAvatar" />
                                            <small class="text-danger" v-if="avatar_error" style="">{{avatar_error}}</small>
                                            <img src=" " id="pre-avatar" style="width: 100px; height: 100px; border: 1px solid #CCCCCC; object-fit: cover; display: none"/>
                                        </div>
                                        <input type="submit" class="btnRegister" :disabled="isDisable" value="নিবন্ধন করুন"/>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-8 text-center" id="success_message" style="margin-left: 166px;"></div>
                                <div class="col-md-8 text-center" id="error_message" style="margin-left: 166px;"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h3  class="register-heading">লগইন করুন</h3>
                            <form @submit.prevent="login" method="post">
                                <div class="row register-form">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" v-model="email" placeholder="Email *" value="" />
                                            <small class="text-danger" v-if="email_error" style="">{{email_error}}</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" v-model="password" placeholder="Password *" value="" />
                                            <small class="text-danger" v-if="password_error" style="">{{password_error}}</small>
                                        </div>
                                        <input type="submit" class="btnRegister"  value="লগইন করুন"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
    data(){
        return {
            isDisable: false,
            isAuthUserId : this.$authUserId ? true : false,
            id: '',
            name: '',
            email: '',
            phone: '',
            gender: '',
            blood_group: '',
            password: '',
            password_confirmation: '',
            avatar: '',

            //error
            errorCount: 0,
            name_error: '',
            password_error: '',
            password_confirmation_error: '',
            phone_error: '',
            gender_error: '',
            blood_group_error: '',
            avatar_error: '',
            email_error: ''
        }
    },
    methods: {
        expertAvatar(e) {
            // $('#editImg').hide()
            if (e.target.files[0]) {
                let image = e.target.files[0];
                if(image['type'] === 'image/jpeg' || image['type'] === 'image/png'){
                    let reader = new FileReader();
                    reader.onload = function ()
                    {
                        let output = document.getElementById('pre-avatar');
                        output.src = reader.result;
                        output.style.display = "block";
                        output.style.width = "65%";
                    }
                    reader.readAsDataURL(event.target.files[0]);
                    this.avatar_error = ''
                }else{
                    //console.log("This file not an Image", 'Error !!');
                    this.image_message()
                }
            }
        },
        resetError(){
            this.name_error = ''
            this.email_error = ''
            this.phone_error = ''
            this.gender_error = ''
            this.blood_group_error = ''
            this.avatar_error = ''
            this.password_error = ''
            this.password_confirmation_error = ''
        },
        store(){
            this.isDisable = true
            this.resetError()
            if (this.name.length === 0) {
                this.name_error = 'The name field is required'
                this.errorCount++
            }

            if (this.phone.length === 0) {
                this.phone_error = 'The phone field is required'
                this.errorCount++
            }

            if (this.gender.length === 0) {
                this.gender_error = 'The gender field is required'
                this.errorCount++
            }

            if (this.blood_group.length === 0) {
                this.blood_group_error = 'The blood group field is required'
                this.errorCount++
            }

            this.avatar = document.getElementById('avatar').value;
            if(this.avatar.length === 0){
                this.avatar_error = 'Image is required'
                this.errorCount++
            }

            if (this.password.length === 0) {
                this.password_error = 'The password field is required'
                this.errorCount++
            }
            if(this.password.length < 8 ){
                this.password_error = 'Password field is required, at least 8 characters'
                this.errorCount++
            }

            if(this.password_confirmation.length === 0 ){
                this.password_confirmation_error = 'Password confirmation field is required'
                this.errorCount++
            }

            let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!re.test(this.email)){
                this.email_error = 'The valid email is required'
                this.errorCount++
            }

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            };
            let donarData = new FormData();
            let avatar = document.getElementById("avatar").files[0];
            donarData.append('avatar', avatar);
            donarData.append('name', this.name);
            donarData.append('phone', this.phone);
            donarData.append('email', this.email);
            donarData.append('gender', this.gender);
            donarData.append('blood_group', this.blood_group);
            donarData.append('password', this.password);
            donarData.append('password_confirmation', this.password_confirmation);

            if (this.errorCount === 0){
                axios.post('/api/donor/registration', donarData, config)
                    .then(response => {
                        if (response.status === 200){
                            this.isDisable = false
                            this.name = ''
                            this.phone = ''
                            this.email = ''
                            this.gender = ''
                            this.blood_group = ''
                            this.password = ''
                            this.password_confirmation = ''
                            let output = document.getElementById('pre-avatar');
                            output.style.display = "none";
                            //Success message
                            this.success_message()
                        }
                    })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        this.isDisable = false
                        //Error message
                        this.error_message()
                        if (error.response.data.errors.name && error.response.data.errors.name.length > 0) {
                            this.name_error = error.response.data.errors.name[0]
                        }

                        if (error.response.data.errors.email && error.response.data.errors.email.length > 0) {
                            this.email_error = error.response.data.errors.email[0]
                        }

                        if (error.response.data.errors.phone && error.response.data.errors.phone.length > 0) {
                            this.phone_error = error.response.data.errors.phone[0]
                        }

                        if (error.response.data.errors.email && error.response.data.errors.email.length > 0) {
                            this.email_error = error.response.data.errors.email[0]
                        }

                        if (error.response.data.errors.gender && error.response.data.errors.gender.length > 0) {
                            this.gender_error = error.response.data.errors.gender[0]
                        }

                        if (error.response.data.errors.blood_group && error.response.data.errors.blood_group.length > 0) {
                            this.blood_group_error = error.response.data.errors.blood_group[0]
                        }

                        if (error.response.data.errors.password && error.response.data.errors.password.length > 0) {
                            this.password_error = error.response.data.errors.password[0]
                        }

                        if (error.response.data.errors.password_confirmation && error.response.data.errors.password_confirmation.length > 0) {
                            this.password_confirmation_error = error.response.data.errors.password_confirmation[0]
                        }

                        if (error.response.data.errors.avatar && error.response.data.errors.avatar.length > 0) {
                            this.avatar_error = error.response.data.errors.avatar[0]
                        }
                    }
                })
            }
        },
        login(){
            this.resetError()
            axios.post('/login', {
                email: this.email,
                password: this.password
            })
            .then(response => {
                if(response.status === 204){
                    this.$router.push({name : 'home'})
                    window.location.reload();
                }
            })
            .catch(error => {
                if (error.response && error.response.status === 422){
                    this.error_message()
                    if (error.response.data.errors.email && error.response.data.errors.email.length > 0) {
                        this.email_error = error.response.data.errors.email[0]
                    }
                    if (error.response.data.errors.password && error.response.data.errors.password.length > 0) {
                        this.password_error = error.response.data.errors.password[0]
                    }
                }
            })
        },
        success_message(){
            let div = document.createElement("div")
            div.setAttribute("class", "alert alert-success")
            div.setAttribute("role", "alert")
            let txt = document.createTextNode('ধন্যবাদ আপনি একটা মহৎ কাজের জন্য রেজিস্ট্রেশন করলেন। ')
            div.appendChild(txt)

            // document.getElementById('success_message_'+key).innerHTML = ''
            document.getElementById('error_message').innerHTML = ''
            document.getElementById('success_message').appendChild(div)

            setTimeout(function() {
                $('#success_message').fadeOut('fast');
            }, 3000); // <-- time in milliseconds
        },

        error_message(){
            let div = document.createElement("div")
            div.setAttribute("class", "alert alert-danger")
            div.setAttribute("role", "alert")
            let txt = document.createTextNode('ভুল তথ্য দিয়েছেন, আবার চেষ্টা করুন।')
            div.appendChild(txt)

            document.getElementById('error_message').appendChild(div)
            document.getElementById('success_message').innerHTML = ''

            setTimeout(function() {
                $('#error_message').fadeOut('fast');
            }, 3000); // <-- time in milliseconds
        },
        image_message(){
            let div = document.createElement("div")
            div.setAttribute("class", "alert alert-danger")
            div.setAttribute("role", "alert")
            let txt = document.createTextNode('আপনার প্রোফাইল ছবির ফরমেট ভুল হয়েছে, png অথবা jpg ব্যবহার করুন।')
            div.appendChild(txt)

            document.getElementById('error_message').appendChild(div)
            document.getElementById('success_message').innerHTML = ''

            setTimeout(function() {
                $('#error_message').fadeOut('fast');
            }, 3000); // <-- time in milliseconds
        },
    }
}
</script>

<style scoped>
.register{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    margin-top: 6%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
</style>
