<template>
    <div>
        <h2></h2>
        <section id="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
                        <div data-aos="zoom-out" style="margin-top: -50px;">
                            <h2>তুচ্ছ নয় রক্তদান, বাঁচাতে পারে একটি প্রাণ</h2>
                            <div class="input-group">
                                <div class="form-outline" style="width: 372px;">
                                    <input type="search" v-model="search" id="form1" class="form-control custom-search-box" placeholder="রক্তের গ্রুপ লিখে এখানে খুজুন" />
                                </div>
                            </div>

                            <div class="tableFixHead">
                                <table v-show="isOpen" style="background-color: white; width: 372px;">
                                    <thead>
                                    <tr style="background-color: #1d643b">
                                        <th width="10" style="font-size: 14px;">Avatar</th>
                                        <th width="10" style="font-size: 14px;">Last donation</th>
                                        <th width="20%" style="font-size: 14px;">Group</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(result, i) in donors" :key="result.id">
                                        <span style="cursor: pointer" @click="showDonar(result)">
                                            <td>
                                                <img :src="result.avatar" height="50" width="50" style="object-fit: cover; border-radius: 100%"><br/>
                                                <span style="font-size: 12px; font-weight: bold">{{ result.name.substr(0,15) }}</span>
                                            </td>
                                        </span>
                                        <td style="text-transform: capitalize" v-if="result.last_donation">{{ moment(result.last_donation).startOf('day').fromNow() }}</td>
                                        <td style="text-transform: capitalize" v-else>Not donate yet</td>
                                        <td style="text-transform: capitalize">{{ result.blood_group }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

<!--                            <table class="table" v-show="isOpen" style="background-color: white; width: 372px;">-->
<!--                                <thead>-->
<!--                                    <tr class="bg-success">-->
<!--                                        <th width="10" style="font-size: 14px;">Avatar</th>-->
<!--                                        <th width="10" style="font-size: 14px;">Name</th>-->
<!--                                        <th width="20%" style="font-size: 14px;">Group</th>-->
<!--                                    </tr>-->
<!--                                </thead>-->
<!--                                <tbody style="overflow-y: auto; height: 200px;">-->
<!--                                    <tr v-for="(result, i) in donors" :key="result.id">-->
<!--                                        <td>-->
<!--                                            <img :src="result.avatar" height="50" width="50" style="object-fit: cover">-->
<!--                                        </td>-->
<!--                                        <td style="font-size: 14px; text-transform: capitalize">{{ result.name }}</td>-->
<!--                                        <td style="font-size: 14px; text-transform: capitalize">{{ result.blood_group }}</td>-->
<!--                                    </tr>-->
<!--                                </tbody>-->
<!--                            </table>-->
                        </div>
                    </div>
                    <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
                        <img :src="'/frontend/assets/img/hero-img.png'" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>
        </section><!-- End Hero -->

        <!-- Modal -->
        <div class="modal fade" id="donorDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="donorName"></h5>
                        <h5 class="modal-title pull-right" id="roktoDin">রক্তদিন</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src=" " id="donotAvatar" height="150" width="150">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Name : </td>
                                            <td>
                                                <span id="name"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email : </td>
                                            <td>
                                                <span id="email"></span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Phone : </td>
                                            <td>
                                                <span id="phone"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Blood group : </td>
                                            <td>
                                                <span id="group"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gender : </td>
                                            <td>
                                                <span id="gender"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Last donation : </td>
                                            <td>
                                                <span id="lastDonation"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    name: "App",
    data(){
        return {
            moment: moment,
            search: '',
            donors: [],
            isOpen: false,
        }
    },
    watch: {
        search(after, before) {
            //console.log(after)
            axios.get('/api/get/search/data/', { params: { search: this.search } })
                .then(response => {
                    if(this.search.length > 0){
                        this.isOpen = true
                        this.donors = response.data.data
                    }else {
                        this.isOpen = false
                    }
                })
                .catch(error => {
                    console.log(error)
                });
        }
    },
    methods:{
        searchData(){
            let data = {
                blood_group: this.search
            }
            axios.get('/api/donor/info/' + this.search)
                .then(response => {
                    console.log(response)
                }).catch(error => {
                    console.log(error)
            })
        },
        showDonar(value){
            axios.get('/api/get/donor-data/' + value.id)
                .then(response => {
                    console.log(response)
                     $('#donorDetails').modal('show')
                     $('#donorName').text(value.name)
                     $('#name').text(response.data.name)
                     $('#email').text(response.data.email)
                     $('#phone').text(response.data.phone)
                     $('#group').text(response.data.blood_group)
                     $('#gender').text(response.data.gender)
                    if (response.data.last_donation){
                        $('#lastDonation').text( moment(response.data.last_donation).startOf('day').fromNow())
                    }
                     $('#donotAvatar').attr('src', response.data.avatar)
                }).catch(error => {
                    console.log(error)
            })
        }
    }
}
</script>

<style scoped>
.custom-search-box{
    width: 100%;
    border-radius: 18px;
}
.tableFixHead {
    overflow-y: auto;
    height: 300px;
}
.tableFixHead thead th {
    position: sticky;
    top: 0;
}
table {
    border-collapse: collapse;
    width: 100%;
}
th,
td {
    padding: 8px 16px;
    border: 1px solid #ccc;
}
th {
    background: #f39c12;
    border-color:#e67e22;
}
</style>
