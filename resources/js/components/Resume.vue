<template>
    <div id="resume-form" class="py-4 px-4 mb-3">
        <div>
            <h2>Personal information</h2>
            <div v-if="basics" class="border px-3 py-2 rounded-2 position-relative">
                <h4 class="mb-0">{{ basics.name + ' ' + basics.surname }}</h4>
                <div class="text-secondary mb-2">{{ basics.city + ', ' + basics.country }} <span v-if="basics.address"> - {{ basics.address }}</span></div>
                <div>
                    <span class="pe-4"><MdEmail class="resumeIcon"/> {{ basics.email }}</span>
                    <span class="pe-4"><FaPhone class="resumeIcon"/> {{ basics.phoneNumber }}</span>
                    <span class="pe-4" v-if="basics.website"><IcInternet class="resumeIcon"/> {{ basics.website }} </span>
                </div>
                <div class="position-absolute top-0 end-0 px-2 py-1">
                    <button class="btn" data-bs-target="#basicsModal" data-bs-toggle="modal">Edit</button>
                </div>
            </div>

            <button class="btn btn-primary my-2" data-bs-target="#basicsModal" data-bs-toggle="modal">Add Basics</button>

            <Modal title="Add Basics" save-text="Save" :submit-action="addBasics" @trigger-submit-action="addBasics" modal-id="basicsModal">
                <div class="form-floating mb-3">
                    <input type="text" v-model="newBasics.name" class="form-control" id="basicsName" placeholder="">
                    <label for="basicsName">Name {{ newBasics.name }}</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" v-model="newBasics.surname" class="form-control" id="basicsSurname" placeholder="">
                    <label for="basicsSurname">Surname</label>
                </div>
                <h4>Contact Details</h4>
                <div class="form-floating mb-3">
                    <input type="email" v-model="newBasics.email" class="form-control" id="basicsEmail" placeholder="">
                    <label for="basicsEmail">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" v-model="newBasics.phoneNumber" class="form-control" id="basicsPhoneNumber" placeholder="">
                    <label for="basicsPhoneNumber">Phone Number</label>
                </div>
                <h4>Address</h4>
                <div class="form-floating mb-3">
                    <input type="text" v-model="newBasics.address" class="form-control" id="basicsAddress" placeholder="">
                    <label for="basicsAddress">Address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" v-model="newBasics.country" class="form-control" id="basicsAddress" placeholder="">
                    <label for="basicsAddress">Address</label>
                </div>
                <div class="row g-2">
                    <div class="form-floating mb-3 col">
                        <input type="text" v-model="newBasics.city" class="form-control" id="basicsCity" placeholder="">
                        <label for="basicsCity">City</label>
                    </div>
                    <div class="form-floating mb-3 col">
                        <input type="text" v-model="newBasics.zipcode" class="form-control" id="basicsZipcode" placeholder="">
                        <label for="basicsZipcode">Zipcode</label>
                    </div>
                </div>
            </Modal>

            <h2>Education</h2>
            <div v-for="education in education_list" class="border px-3 py-2 rounded-2">
                <h4>{{ education.school }} </h4>
                <div>{{ education.faculty }} {{ education.direction }} </div>
                <div class="text-secondary">{{ education.timeFrom }} - {{ education.timeTo }} </div>
                <div>{{ education.level }} </div>
                <div>{{ education.description }} </div>
            </div>

            <button class="btn btn-primary my-2" data-bs-target="#educationModal" data-bs-toggle="modal">Add Education</button>
            <Modal title="Add Education" save-text="Add" :submit-action="addEducation" @trigger-submit-action="addEducation" modal-id="educationModal">
                <div class="form-floating mb-3">
                    <input type="text" v-model="newEducation.school" class="form-control" id="educationSchool" placeholder="">
                    <label for="educationSchool">School</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" v-model="newEducation.faculty" class="form-control" id="educationFaculty" placeholder="">
                    <label for="educationFaculty">Faculty</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" v-model="newEducation.direction" class="form-control" id="direction" placeholder="">
                    <label for="direction">Direction</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" v-model="newEducation.level" class="form-control" id="level" placeholder="">
                    <label for="level">Level</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" v-model="newEducation.status" class="form-control" id="status" placeholder="">
                    <label for="status">Status</label>
                </div>
                <div class="row g-2">
                    <div class="form-floating mb-3 col">
                        <input type="text" v-model="newEducation.timeFrom" class="form-control" id="timeStudying" placeholder="">
                        <label for="timeStudying">Time From</label>
                    </div>
                    <div class="form-floating mb-3 col">
                        <input type="text" v-model="newEducation.timeTo" class="form-control" id="timeStudying" placeholder="">
                        <label for="timeStudying">Time To</label>
                    </div>
                </div>
                <div class="form-check mb-3 col">
                    <input class="form-check-input" v-model="newEducation.currentlyStudying" type="checkbox" id="currentlyStudying">
                    <label class="form-check-label" for="currentlyStudying">
                        Currently Studying
                    </label>
                </div>
            </Modal>

            <h2>Work experience</h2>
            <div class="form-floating mb-3 w-25">
                <input type="text" v-model="work.employer" class="form-control" id="employer" placeholder="">
                <label for="employer">Employer</label>
            </div>
            <div class="form-floating mb-3 w-25">
                <input type="text" v-model="work.position" class="form-control" id="position" placeholder="">
                <label for="position">Position</label>
            </div>
            <div class="form-floating mb-3 w-25">
                <input type="text" v-model="work.type" class="form-control" id="type" placeholder="">
                <label for="type">Type</label>
            </div>
            <div class="form-floating mb-3 w-25">
                <input type="text" v-model="work.timeFrom" class="form-control" id="timeFrom" placeholder="">
                <label for="timeFrom">Time From</label>
            </div>
            <div class="form-floating mb-3 w-25">
                <input type="text" v-model="work.timeTo" class="form-control" id="timeTo" placeholder="">
                <label for="timeTo">Time To</label>
            </div>
        </div>
    </div>
</template>

<script setup>
import { MdEmail } from "@kalimahapps/vue-icons";
import { FaPhone } from "@kalimahapps/vue-icons";
import { IcInternet } from "@kalimahapps/vue-icons";
import { ref, reactive } from 'vue';
import Modal from './Modal.vue';

const initialBasics = {
    'name': '',
    'surname': '',
    'email': '',
    'phoneNumber': '',
    'website': '',
    'country': '',
    'address': '',
    'city': '',
    'zipcode': '',
};
// TODO remove these testing values
const realBasics = {
    'name': 'Gustavs',
    'surname': 'Zubars',
    'email': 'gustavs.zubars@gmail.com',
    'phoneNumber': '28343205',
    'country': 'Latvija',
    'address': 'Lacplesa iela 116',
    'city': 'Rīga',
    'zipcode': 'LV-1003',
};
const basics = reactive({
    ...realBasics
});
const newBasics = reactive({
    ...(realBasics || initialBasics)
});

const education_list = reactive([]);
const initialEducation = {
    'id': '',
    'school': '',
    'faculty': '',
    'direction': '',
    'level': '',
    'status': '',
    'currentlyStudying': false,
    'timeFrom': '',
    'timeTo': '',
};
const newEducation = reactive({
    ...initialEducation
})

const work = reactive({
    'employer': '',
    'position': '',
    'type': '',
    'timeFrom': '',
    'timeTo': '',
});
const workSkills = reactive({
    'description': '',
    'type': '',
});

// TODO remove these testing values
education_list.push({
    'id': 0,
    'school': 'Rīgas Valsts tehnikums',
    'faculty': 'Faculty',
    'direction': 'Grāmatvedība',
    'level': '1',
    'description': 'Gained skills and competences in accounting, such as:\n' +
        '- work out the company chart of accounts;\n' +
        '- apply the double-entry method account.',
    'currentlyStudying': false,
    'timeFrom': '2018',
    'timeTo': '2022',
})

function addEducation() {
    education_list.push({
        'id': newEducation.id,
        'school': newEducation.school,
        'faculty': newEducation.faculty,
        'direction': newEducation.direction,
        'level': newEducation.level,
        'status': newEducation.status,
        'currentlyStudying': false,
        'timeFrom': newEducation.timeFrom,
        'timeTo': newEducation.timeTo,
    });
    Object.assign(newEducation, { ...initialEducation });
}

function addBasics() {
    Object.assign(basics, { ...newBasics });
}

function showModal(id) {
    document.getElementById(id).style.display = 'block';
}
</script>
