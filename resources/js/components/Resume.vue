<template>
    <Modal title="Add Basics" save-text="Save"
           :show-delete-button="isEditing"
           :delete-action="deleteBasics"
           @trigger-delete-action="deleteBasics"
           :submit-action="submitBasics"
           @trigger-submit-action="submitBasics"
           modal-id="basicsModal">
        <h4>Personal information</h4>
        <div class="form-floating mb-3">
            <input type="text" v-model="newBasics.name" class="form-control" id="basicsName" placeholder="">
            <label for="basicsName">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" v-model="newBasics.surname" class="form-control" id="basicsSurname"
                   placeholder="">
            <label for="basicsSurname">Surname</label>
        </div>
        <h4>Contact Details</h4>
        <div class="form-floating mb-3">
            <input type="email" v-model="newBasics.email" class="form-control" id="basicsEmail" placeholder="">
            <label for="basicsEmail">Email</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" v-model="newBasics.phoneNumber" class="form-control" id="basicsPhoneNumber"
                   placeholder="">
            <label for="basicsPhoneNumber">Phone Number</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" v-model="newBasics.website" class="form-control" id="basicsPhoneNumber"
                   placeholder="">
            <label for="basicsPhoneNumber">Website</label>
        </div>
        <h4>Address</h4>
        <div class="form-floating mb-3">
            <input type="text" v-model="newBasics.address" class="form-control" id="basicsAddress"
                   placeholder="">
            <label for="basicsAddress">Address</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" v-model="newBasics.country" class="form-control" id="basicsAddress"
                   placeholder="">
            <label for="basicsAddress">Address</label>
        </div>
        <div class="row g-2">
            <div class="form-floating mb-3 col">
                <input type="text" v-model="newBasics.city" class="form-control" id="basicsCity" placeholder="">
                <label for="basicsCity">City</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" v-model="newBasics.zipcode" class="form-control" id="basicsZipcode"
                       placeholder="">
                <label for="basicsZipcode">Zipcode</label>
            </div>
        </div>
    </Modal>

    <Modal title="Add Education"
           :save-text="isEditing ? 'Save' : 'Add'"
           :show-delete-button="isEditing"
           :delete-action="deleteEducation"
           @trigger-delete-action="deleteEducation"
           :submit-action="submitEducation"
           @trigger-submit-action="submitEducation"
           modal-id="educationModal">
        <div class="form-floating mb-3">
            <input type="text" v-model="newEducation.school" class="form-control" id="educationSchool"
                   placeholder="">
            <label for="educationSchool">School</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" v-model="newEducation.faculty" class="form-control" id="educationFaculty"
                   placeholder="">
            <label for="educationFaculty">Faculty</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" v-model="newEducation.direction" class="form-control" id="educationDirection"
                   placeholder="">
            <label for="educationDirection">Direction</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" v-model="newEducation.level" class="form-control" id="educationLevel"
                   placeholder="">
            <label for="educationLevel">Level</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" v-model="newEducation.status" class="form-control" id="educationStatus"
                   placeholder="">
            <label for="educationStatus">Status</label>
        </div>
        <div class="row g-2">
            <div class="form-floating mb-3 col">
                <input type="text" v-model="newEducation.from" class="form-control" id="educationFrom"
                       placeholder="">
                <label for="educationFrom">Time From</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" v-model="newEducation.to" class="form-control" id="educationTo"
                       placeholder="">
                <label for="educationTo">Time To</label>
            </div>
        </div>
        <div class="form-check mb-3 col">
            <input class="form-check-input" v-model="newEducation.currentlyStudying" type="checkbox"
                   id="educationCurrently">
            <label class="form-check-label" for="educationCurrently">
                Currently Studying
            </label>
        </div>
    </Modal>
    <Modal title="Add Work"
           :save-text="isEditing ? 'Save' : 'Add'"
           :show-delete-button="isEditing"
           :delete-action="deleteWork"
           @trigger-delete-action="deleteWork"
           :submit-action="submitWork"
           @trigger-submit-action="submitWork"
           modal-id="workModal">
        <div class="form-floating mb-3">
            <input type="text" v-model="newWork.employer" class="form-control" id="workEmployer" placeholder="">
            <label for="direction">Direction</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" v-model="newWork.position" class="form-control" id="workPosition" placeholder="">
            <label for="level">Level</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" v-model="newWork.type" class="form-control" id="workType" placeholder="">
            <label for="status">Status</label>
        </div>
        <div class="row g-2">
            <div class="form-floating mb-3 col">
                <input type="text" v-model="newWork.from" class="form-control" id="workFrom" placeholder="">
                <label for="workFrom">Time From</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" v-model="newWork.to" class="form-control" id="workTo" placeholder="">
                <label for="workTo">Time To</label>
            </div>
        </div>
        <div class="form-floating">
                    <textarea class="form-control" v-model="newWork.description" id="workDescription"
                              placeholder="Description" style="height: 100px"></textarea>
            <label for="workDescription">Description</label>
        </div>
    </Modal>

    <div id="resume-form" class="py-4 px-4 mb-3">
        <div @mouseenter="highlightAdd" @mouseleave="unHighlightAdd" class="py-3">
            <h2>
                Basics
                <button v-if="Object.values(basics).every(value => value === '')" class="btn addNew my-2" data-bs-target="#basicsModal" data-bs-toggle="modal">
                    <BsPlusCircle class="resumeIcon d-flex"/>
                </button>
            </h2>

            <div v-if="!Object.values(basics).every(value => value === '')" class="border px-3 py-2 rounded-2 position-relative"
                 @mouseenter="highlightEdit" @mouseleave="unHighlightEdit">
                <h4 class="mb-0">{{ basics.name + ' ' + basics.surname }}</h4>
                <div class="text-secondary mb-2">{{ basics.city + ', ' + basics.country }} <span v-if="basics.address"> - {{ basics.address }}</span></div>
                <div><span class="pe-4"><MdEmail class="resumeIcon"/> {{ basics.email }}</span>
                    <span class="pe-4"><FaPhone class="resumeIcon"/> {{ basics.phoneNumber }}</span>
                    <span class="pe-4" v-if="basics.website"><IcInternet class="resumeIcon"/> {{ basics.website }} </span>
                </div>
                <div class="position-absolute top-0 end-0 px-2 py-1">
                    <button class="btn editButton text-black text-opacity-25" data-bs-target="#basicsModal"
                            data-bs-toggle="modal" @click="editBasics()">Edit
                    </button>
                </div>
            </div>
        </div>

        <div @mouseenter="highlightAdd" @mouseleave="unHighlightAdd" class="py-3">
            <h2>
                Education
                <button class="btn addNew my-2" data-bs-target="#educationModal" data-bs-toggle="modal"
                        @click="addEducation">
                    <BsPlusCircle class="resumeIcon d-flex"/>
                </button>
            </h2>
            <ul class="list-group list-group-flush position-relative">
                <li v-for="education in education_list" class="list-group-item" @mouseenter="highlightEdit"
                    @mouseleave="unHighlightEdit">
                    <h4>{{ education.school }} </h4>
                    <div>{{ education.faculty }} {{ education.direction }}</div>
                    <div class="text-secondary">{{ education.from }} - {{ education.to }}</div>
                    <div>{{ education.level }}</div>
                    <div>{{ education.description }}</div>
                    <div class="position-absolute top-0 end-0 px-2 py-1">
                        <button class="btn editButton text-black text-opacity-25" data-bs-target="#educationModal"
                                data-bs-toggle="modal" @click="editEducation(education.id)">Edit
                        </button>
                    </div>
                </li>
            </ul>
        </div>

        <div @mouseenter="highlightAdd" @mouseleave="unHighlightAdd" class="py-3">
            <h2>
                Work experience
                <button class="btn addNew my-2" data-bs-target="#workModal" data-bs-toggle="modal"
                        @click="addWork">
                    <BsPlusCircle class="resumeIcon d-flex"/>
                </button>
            </h2>
            <ul class="list-group list-group-flush position-relative">
                <li v-for="work in work_list" class="list-group-item" @mouseenter="highlightEdit" @mouseleave="unHighlightEdit">
                    <h4>{{ work.employer }} </h4>
                    <div>{{ work.position }} {{ work.type }}</div>
                    <div class="text-secondary">{{ work.from }} - {{ work.to }}</div>
                    <div class="pb-2">{{ work.description }}</div>
                    <div class="position-absolute top-0 end-0 px-2 py-1">
                        <button class="btn editButton text-black text-opacity-25" data-bs-target="#workModal"
                                data-bs-toggle="modal" @click="editWork(work.id)">Edit
                        </button>
                    </div>
                </li>
            </ul>
        </div>
        <button class="btn btn-primary mt-4 w-25 ms-auto" @click="saveResume">
            Save Resume
        </button>
    </div>
</template>

<script setup>
import {MdEmail} from "@kalimahapps/vue-icons";
import {FaPhone} from "@kalimahapps/vue-icons";
import {IcInternet} from "@kalimahapps/vue-icons";
import {MiLightbulbShine} from "@kalimahapps/vue-icons";
import {BsPlusCircle} from "@kalimahapps/vue-icons";

import {ref, reactive} from 'vue';
import Modal from './Modal.vue';

const isEditing = ref(false);

// Basics
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
const basics = reactive({});
const newBasics = reactive({
    ...initialBasics
});

// Education
const education_list = reactive([]);
const initialEducation = {
    'id': '',
    'school': '',
    'faculty': '',
    'direction': '',
    'level': '',
    'status': '',
    'currentlyStudying': false,
    'from': '',
    'to': '',
};
const newEducation = reactive({
    ...initialEducation
})

// Work
const work_list = reactive([]);
const initialWork = {
    'id': '0',
    'employer': 'Employer',
    'position': 'Software Engineer',
    'type': 'full-time',
    'from': '2023',
    'to': '3000',
    'description': 'Something...',
};
const newWork = reactive({
    ...initialWork
})
const work = reactive({
    ...initialWork
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
    'from': '2018',
    'to': '2022',
})

function editBasics() {
    isEditing.value = true;
}
function submitBasics() {
    Object.assign(basics, {...newBasics});
}
function deleteBasics() {
    Object.assign(basics, {...initialBasics});
}

function addEducation() {
    isEditing.value = false;
    Object.assign(newEducation, {...initialEducation});
}

function submitEducation() {
    if (isEditing.value) {
        Object.assign(education_list[newEducation.id], {...newEducation});
    } else {
        education_list.push({
            'id': education_list.length,
            'school': newEducation.school,
            'faculty': newEducation.faculty,
            'direction': newEducation.direction,
            'level': newEducation.level,
            'status': newEducation.status,
            'currentlyStudying': false,
            'from': newEducation.from,
            'to': newEducation.to,
        });
    }
}

function deleteEducation() {
    education_list.splice(parseInt(newEducation.id), 1)
}

function editEducation(id) {
    isEditing.value = true;
    Object.assign(newEducation, {...education_list[id]});
}

function addWork() {
    isEditing.value = false;
    Object.assign(newWork, {...initialWork});
}

function submitWork() {
    if (isEditing.value) {
        Object.assign(work_list[newWork.id], {...newWork});
    } else {
        work_list.push({
            'id': work_list.length,
            'employer': newWork.employer,
            'position': newWork.position,
            'type': newWork.type,
            'from': newWork.from,
            'to': newWork.to,
            'description': newWork.description,
            'skills': newWork.skills
        });
    }
}

function deleteWork() {
    work_list.splice(parseInt(newWork.id), 1)
}

function editWork(id) {
    isEditing.value = true;
    Object.assign(newWork, {...work_list[id]});
}

function highlightAdd(e) {
    $(e.target).find('.addNew').addClass('btn-secondary');
}
function unHighlightAdd(e) {
    $(e.target).find('.addNew').removeClass('btn-secondary');
}

function highlightEdit(e) {
    $(e.target).find('.editButton').removeClass('text-black text-opacity-25');
}
function unHighlightEdit(e) {
    $(e.target).find('.editButton').addClass('text-black text-opacity-25');
}
</script>
