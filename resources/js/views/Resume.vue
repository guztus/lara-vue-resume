<style xmlns="http://www.w3.org/1999/html">
.editButton {
    display: none;
}

textarea {
    overflow-wrap: break-word;
}

.sectionItem {
    cursor: pointer;
    overflow-wrap: break-word;
}

.form-check {
    cursor: pointer;
}

.sectionItem:hover {
    background-color: #f8f9fa !important;
    .editButton {
        display: block;
    }
}

.previewMode {
    button {
        display: none;
    }
    .editButton {
        display: none !important;
    }
}

.element-error-flash {
    animation: element-error-flash 2s;
    -moz-animation: element-error-flash 2s; /* Firefox */
    -webkit-animation: element-error-flash 2s; /* Safari and Chrome */
    -o-animation: element-error-flash 2s; /* Opera */
}

@keyframes element-error-flash {
    25% {
        background-color: rgba(255, 0, 0, 0.28);
    }
    50% {
        background-color: transparent;
    }
    75% {
        background-color: rgba(255, 0, 0, 0.28);
    }
    100% {
        background-color: transparent;
    }
}
</style>

<template>
    <div class="container-xxl md-4 bg-white shadow p-4" style="min-height: calc(100vh - 86px);">
        <Modal
            title="Delete resume"
            save-text="Confirm"
            :submit-action="deleteResume"
            @trigger-submit-action="deleteResume"
            :close-on-submit="false"
            modal-id="deleteResume"
        >
            <h4>Are you sure you want to delete this resume?</h4>
        </Modal>

        <Modal
            title="Add Basics" save-text="Save"
            :show-delete-button="isEditing"
            :delete-action="deleteBasics"
            @trigger-delete-action="deleteBasics"
            :submit-action="submitBasics"
            @trigger-submit-action="submitBasics"
            :close-on-submit="false"
            modal-id="basicsModal"
        >
            <h4>Personal information</h4>
            <div class="form-floating mb-3">
                <input
                    type="text"
                    v-model="newBasics.name"
                    class="form-control"
                    :class="{ 'is-invalid': v$.newBasics.name.$errors.length > 0 }"
                    id="basicsName"
                    placeholder=""
                >
                <label for="basicsName">Name</label>
                <span v-for="error in v$.newBasics.name.$errors" :key="error.$uid" class="text-danger fst-italic">
                   {{ error.$message }}
                </span>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    v-model="newBasics.surname"
                    class="form-control"
                    :class="{ 'is-invalid': v$.newBasics.surname.$errors.length > 0 }"
                    id="basicsSurname"
                    placeholder=""
                >
                <label for="basicsSurname">Surname</label>
                <span v-for="error in v$.newBasics.surname.$errors" :key="error.$uid" class="text-danger fst-italic">
                   {{ error.$message }}
                </span>
            </div>

            <h4>Contact Details</h4>
            <div class="form-floating mb-3">
                <input
                    type="email"
                    v-model="newBasics.email"
                    class="form-control"
                    :class="{ 'is-invalid': v$.newBasics.email.$errors.length > 0 }"
                    id="basicsEmail"
                    placeholder=""
                >
                <label for="basicsEmail">Email</label>
            </div>
            <span v-for="error in v$.newBasics.email.$errors" :key="error.$uid" class="text-danger fst-italic">
                   {{ error.$message }}
                </span>

            <div class="form-floating mb-3">
                <input type="text" v-model="newBasics.phoneNumber" class="form-control" id="basicsPhoneNumber"
                       placeholder="">
                <label for="basicsPhoneNumber">Phone Number</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" v-model="newBasics.website" class="form-control" id="basicsWebsite"
                       placeholder="">
                <label for="basicsWebsite">Website</label>
            </div>
            <h4>Address</h4>
            <div class="form-floating mb-3">
                <input type="text" v-model="newBasics.address" class="form-control" id="basicsAddress"
                       placeholder="">
                <label for="basicsAddress">Address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" v-model="newBasics.country" class="form-control" id="basicsCountry"
                       placeholder="">
                <label for="basicsCountry">Country</label>
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

        <Modal
            title="Add Education"
            :save-text="isEditing ? 'Save' : 'Add'"
            :show-delete-button="isEditing"
            :delete-action="deleteEducation"
            @trigger-delete-action="deleteEducation(newEducation.id)"
            :submit-action="submitEducation"
            @trigger-submit-action="submitEducation"
            :close-on-submit="false"
            modal-id="educationModal"
        >
            <div class="form-floating mb-3">
                <input
                    type="text"
                    v-model="newEducation.school"
                    class="form-control"
                    :class="{ 'is-invalid': v$.newEducation.school.$errors.length > 0 }"
                    id="educationSchool"
                    placeholder=""
                >
                <label for="educationSchool">School</label>
                <span v-for="error in v$.newEducation.school.$errors" :key="error.$uid" class="text-danger fst-italic">
                        {{ error.$message }}
                    </span>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    v-model="newEducation.faculty"
                    class="form-control"
                    :class="{ 'is-invalid': v$.newEducation.faculty.$errors.length > 0 }"
                    id="educationFaculty"
                    placeholder=""
                >
                <label for="educationFaculty">Faculty</label>
                <span v-for="error in v$.newEducation.faculty.$errors" :key="error.$uid" class="text-danger fst-italic">
                        {{ error.$message }}
                    </span>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    v-model="newEducation.direction"
                    class="form-control"
                    :class="{ 'is-invalid': v$.newEducation.direction.$errors.length > 0 }"
                    id="educationDirection"
                    placeholder=""
                >
                <label for="educationDirection">Direction</label>
                <span v-for="error in v$.newEducation.direction.$errors" :key="error.$uid" class="text-danger fst-italic">
                    {{ error.$message }}
                </span>
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
            <div class="form-check mb-3 col">
                <input
                    id="educationCurrently"
                    class="form-check-input"
                    v-model="newEducation.currentlyActive"
                    type="checkbox"
                    @change="currentlyActiveCheckbox(newEducation)"
                >
                <label class="form-check-label" for="educationCurrently">
                    Currently Studying
                </label>
            </div>
            <div class="row g-2">
                <div class="mb-3 col">
                    <label for="educationFrom">Time From</label>
                    <Datepicker
                        id="educationFrom"
                        v-model="newEducation.from"
                        :class="{ 'datepicker-input-invalid': v$.newEducation.from.$errors.length > 0 }"
                        :input-class-name="v$.newEducation.from.$errors.length > 0 ? 'form-control is-invalid' : ''"
                        month-picker
                        auto-apply
                        model-type="MM/yyyy"
                    />
                    <span v-for="error in v$.newEducation.from.$errors" :key="error.$uid" class="text-danger fst-italic">
                        {{ error.$message }}
                    </span>
                </div>
                <div class="mb-3 col">
                    <label for="educationFrom" :class="{ 'text-secondary': newEducation.currentlyActive }">Time From</label>
                    <Datepicker
                        :disabled="newEducation.currentlyActive"
                        id="educationTo"
                        v-model="newEducation.to"
                        month-picker
                        auto-apply
                        model-type="MM/yyyy"
                    />
                </div>
            </div>
        </Modal>

        <Modal
            title="Add Work"
            :save-text="isEditing ? 'Save' : 'Add'"
            :show-delete-button="isEditing"
            :delete-action="deleteWork"
            @trigger-delete-action="deleteWork()"
            :submit-action="submitWork"
            @trigger-submit-action="submitWork"
            :close-on-submit="false"
            modal-id="workModal"
        >
            <div class="form-floating mb-3">
                <input
                    type="text" v-model="newWork.employer"
                    class="form-control"
                    :class="{ 'is-invalid': v$.newWork.employer.$errors.length > 0 }"
                    id="workEmployer"
                    placeholder=""
                >
                <label for="direction">Employer</label>
                <span
                    v-for="error in v$.newWork.employer.$errors"
                    :key="error.$uid"
                    class="text-danger fst-italic"
                >
                    {{ error.$message }}
                </span>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    v-model="newWork.position"
                    class="form-control"
                    :class="{ 'is-invalid': v$.newWork.position.$errors.length > 0 }"
                    id="workPosition"
                    placeholder=""
                >
                <label for="level">Position</label>
                <span
                    v-for="error in v$.newWork.position.$errors"
                    :key="error.$uid"
                    class="text-danger fst-italic"
                >
                    {{ error.$message }}
                </span>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    v-model="newWork.type"
                    class="form-control"
                    id="workType"
                    placeholder=""
                >
                <label for="status">Type</label>
            </div>

            <div class="form-check mb-3 col">
                <input
                    id="workCurrently"
                    class="form-check-input"
                    v-model="newWork.currentlyActive"
                    type="checkbox"
                    @change="currentlyActiveCheckbox(newWork)"
                >
                <label class="form-check-label" for="workCurrently">
                    Currently Working
                </label>
            </div>

            <div class="row g-2">
                <div class="mb-3 col">
                    <label for="workFrom">
                        Time From
                    </label>
                    <Datepicker
                        id="workFrom"
                        v-model="newWork.from"
                        :class="{ 'datepicker-input-invalid': v$.newWork.from.$errors.length > 0 }"
                        :input-class-name="v$.newWork.from.$errors.length > 0 ? 'form-control is-invalid' : ''"
                        month-picker
                        auto-apply
                        model-type="MM/yyyy"
                    />
                    <span v-for="error in v$.newWork.from.$errors" :key="error.$uid" class="text-danger fst-italic">
                        {{ error.$message }}
                    </span>
                </div>

                <div class="mb-3 col">
                    <label for="workFrom">
                        Time To
                    </label>
                    <Datepicker
                        :disabled="newWork.currentlyActive"
                        id="workTo"
                        v-model="newWork.to"
                        month-picker
                        auto-apply
                        model-type="MM/yyyy"
                    />
                </div>
            </div>

            <div class="form-floating">
                        <textarea
                            class="form-control"
                            v-model="newWork.description"
                            id="workDescription"
                            placeholder="Description"
                            style="height: 160px"
                            maxlength="2000"
                        ></textarea>
                <label for="workDescription">Description</label>
                <span v-for="error in v$.newWork.description.$errors" :key="error.$uid" class="text-danger fst-italic">
                    {{ error.$message }}
                </span>
            </div>
        </Modal>

        <div class="text-center">
            <div class="d-inline-block fs-3 fw-bold">Resume #</div>
            <input
                id="name"
                class="text-start d-inline-block border-bottom ps-1 form-control-lg fw-bold rounded-0 pb-0 pt-3"
                type="text"
                v-model="resumeName"
                placeholder=""
                autocomplete="off"
                style="width: 245px"
            >
        </div>

        <div class="text-end pe-4">
                View mode:
            <div class="form-check d-inline-block ms-2 me-3">
                <input
                    v-model="viewMode"
                    @change="viewModeChange"
                    class="form-check-input"
                    type="radio"
                    name="editMode"
                    value="edit"
                    id="editMode"
                >
                <label
                    class="form-check-label"
                    for="editMode"
                >
                    Edit
                </label>
            </div>
            <div class="form-check d-inline-block">
                <input
                    v-model="viewMode"
                    @change="viewModeChange"
                    class="form-check-input"
                    type="radio"
                    value="preview"
                    name="previewMode"
                    id="previewMode"
                >
                <label
                    class="form-check-label"
                    for="previewMode"
                >
                    Print Preview
                </label>
            </div>
        </div>

        <div id="resume-form" class="py-4 px-4 mb-3">
            <div
                id="basicsSection"
                @mouseenter="hoverOverSection.basics = true"
                @mouseleave="hoverOverSection.basics = false"
                class="pt-3 border border-bottom rounded-top-2"
                :class="{ 'd-none': hideSection.basics }"
            >
                <div class="fs-3 ms-4 mb-2 fw-bold">
                    Basics
                    <button
                        v-if="Object.values(basics).every(value => !value)"
                        class="btn my-2"
                        :class="{ 'btn-secondary': hoverOverSection.basics }"
                        @click="addBasics"
                    >
                        <BsPlusCircle class="resumeIcon d-flex"/>
                    </button>
                </div>
                <div
                    v-if="!Object.values(basics).every(value => !value)"
                    class="pt-2 pb-3 rounded-bottom px-3 position-relative sectionItem"
                    @click="viewMode !== 'preview' && editBasics()"
                >
                    <h4 class="mb-0">{{ basics.name }} {{ basics.surname }}</h4>
                    <div class="text-secondary mb-2">{{ (basics.city && basics.country) ? basics.city + ',' : basics.city }} {{ basics.country }} <span v-if="basics.address"> - {{ basics.address }}</span></div>
                    <div>
                        <span class="pe-4" v-if="basics.email"><MdEmail class="resumeIcon"/> {{ basics.email }}</span>
                        <span class="pe-4" v-if="basics.phoneNumber"><FaPhone class="resumeIcon"/> {{ basics.phoneNumber }}</span>
                        <span class="pe-4" v-if="basics.website"><IcInternet class="resumeIcon"/> {{ basics.website }} </span>
                    </div>
                    <div class="position-absolute top-0 end-0 px-2 py-1">
                        <button
                            class="btn editButton text-black text-opacity-25"
                        >
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <div
                @mouseenter="hoverOverSection.work = true"
                @mouseleave="hoverOverSection.work = false"
                class="pt-3 border-start border-end"
                :class="{
                    'd-none': hideSection.work,
                    'border-top rounded-top-2': hideSection.basics,
                    'rounded-bottom-0': hideSection.education
                }"
            >
                <div class="fs-3 ms-4 mb-2 fw-bold">
                    Work experience
                    <button
                        class="btn my-2"
                        :class="{ 'btn-secondary': hoverOverSection.work }"
                        @click="addWork"
                    >
                        <BsPlusCircle class="resumeIcon d-flex"/>
                    </button>
                </div>
                <ul id="workSection" class="list-group list-group-flush position-relative">
                    <li
                        v-for="(work, index) in workList.filter(work => !work?.deleted)"
                        class="list-group-item sectionItem"
                        :class="{ 'pb-3': (index === workList.length -1) }"
                        @click="viewMode !== 'preview' && editWork(work)"
                    >
                        <div class="fs-5 fw-bold">{{ work.position }}</div>
                        <div>{{ work.employer }}<span class="fst-italic text-secondary">{{ work.type ? ' - ' + work.type : '' }}</span></div>
                        <div class="text-secondary">{{ work.from }} {{ work.to ? '- ' + work.to : '- Present' }}</div>
                        <div v-if="work.description" class="pt-3 pb-2" style="white-space: pre-line;">{{ work?.description }}</div>
                        <div class="position-absolute top-0 end-0 px-2 py-1">
                            <button
                                class="btn editButton text-black text-opacity-25"
                            >Edit
                            </button>
                        </div>
                    </li>
                </ul>
            </div>

            <div
                @mouseenter="hoverOverSection.education = true"
                @mouseleave="hoverOverSection.education = false"
                class="pt-3 border rounded-2 rounded-top-0"
                :class="{ 'd-none': hideSection.education }"
            >
                <div class="fs-3 ms-4 mb-2 fw-bold">
                    Education
                    <button
                        class="btn my-2"
                        :class="{ 'btn-secondary': hoverOverSection.education }"
                        @click="addEducation"
                    >
                        <BsPlusCircle class="resumeIcon d-flex"/>
                    </button>
                </div>
                <ul id="educationSection" class="list-group list-group-flush position-relative">
                    <li
                        v-for="(education, index) in educationList.filter(education => !education?.deleted)"
                        class="list-group-item sectionItem"
                        :class="{ 'pb-3 rounded-bottom-2': (index === educationList.length -1) }"
                        @click="viewMode !== 'preview' && editEducation(education)"
                    >
                        <h4 class="mb-0">{{ education.school }} </h4>
                        <div>{{ education.faculty + ', ' }}{{ education.direction }}</div>
                        <div class="text-secondary">{{ education.from }} {{ education.to ? '- ' + education.to : '- Present' }}</div>
                        <div>{{ education.level }}</div>
                        <div style="white-space: pre;">{{ education.description }}</div>
                        <div class="position-absolute top-0 end-0 px-2 py-1">
                            <button class="btn editButton text-black text-opacity-25">Edit
                            </button>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="text-end">
                <button v-if="props.id" class="btn btn-outline-danger mt-5 ms-auto me-3" @click="deleteResumePrompt" style="width: 180px;">
                Delete
                </button>
                <button class="btn btn-primary mt-5 ms-auto" @click="saveResume" style="width: 180px;">
                    Save
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import {MdEmail, FaPhone, IcInternet, BsPlusCircle} from "@kalimahapps/vue-icons";
import {ref, onMounted} from 'vue';
import Modal from '../components/Modal.vue';
import axios from "axios";
import router from '../router'
import {minLength, maxLength, required, email} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import {createToaster} from '@meforma/vue-toaster'
import Datepicker from '@vuepic/vue-datepicker';

import '@vuepic/vue-datepicker/dist/main.css';

const successMessage = createToaster({ type: 'success', position: 'top' })
const errorMessage = createToaster({ type: 'error', position: 'top' })

const props = defineProps({
    id: {
        type: String,
        required: false
    }
})

let basicsModalInstance
let educationModalInstance
let workModalInstance
let deleteModalInstance

onMounted(() => {
    basicsModalInstance = new bootstrap.Modal('#basicsModal')
    educationModalInstance = new bootstrap.Modal('#educationModal')
    workModalInstance = new bootstrap.Modal('#workModal')

    deleteModalInstance = new bootstrap.Modal('#deleteResume')

    document.querySelectorAll('input').forEach(function(inputElement) {
        inputElement.setAttribute('maxlength', '255');
    });
})

let newEducationId = 0;
let newWorkId = 0;

const errors = ref();
const isEditing = ref(false);
const resumeName = ref((new Date()).toLocaleString());

const viewMode = ref('edit');
const hideSection = ref({
    basics: false,
    work: false,
    education: false,
});

const hoverOverSection = ref({
    basics: false,
    education: false,
    work: false,
    custom: false
});

// Basics
const basics = ref({});
const newBasics = ref({});

// Education
const educationList = ref([]);
const newEducation = ref({})

// Work
const workList = ref([]);
const newWork = ref({})

function setData(id) {
    axios
        .get('/api/resume/' + (id ?? props.id))
        .then((res) => {
            resumeName.value = res.data.name;
            console.log(res.data)

            basics.value = res.data.basic ?? {};
            educationList.value = res.data.education ?? {};
            sortListByDate(educationList.value)
            workList.value = res.data.work ?? {};
            sortListByDate(workList.value)

            newEducationId = Math.max(0, ...educationList.value.map(item => item.id)) + 1;
            newWorkId = Math.max(0, ...workList.value.map(item => item.id)) + 1;
        })
        .catch((err) => {
            if (err.response.data.errors) {
                for (const property in err.response.data.errors) {
                    err.response.data.errors[property].forEach((error) => {
                        errorMessage.show(error)
                    })
                }
            } else if (err.response.data.message) {
                errorMessage.show(err.response.data.message)
            }
            router.push('/')
        })
}

if (props.id) {
    setData();
}

function viewModeChange() {
    if (viewMode.value === 'preview') {
        document.getElementById('resume-form').classList.add("previewMode")
        if (Object.values(basics.value).every(value => !value)) hideSection.value.basics = true
        if (workList.value.length < 1) hideSection.value.work = true
        if (educationList.value.length < 1) hideSection.value.education = true
    } else {
        document.getElementById('resume-form').classList.remove("previewMode")
        Object.keys(hideSection.value).forEach(el => hideSection.value[el] = false)
    }
}

const rules = {
    newBasics: {
        name: {
            required,
        },
        surname: {
            required,
        },
        email: {
            email
        }
    },
    newEducation: {
        school: {
            required,
        },
        faculty: {
            required,
        },
        direction: {
            required,
        },
        from: {
            required,
        },
    },
    newWork: {
        employer: {
            required,
        },
        position: {
            required,
        },
        from: {
            required,
        },
        description: {
            maxLength: maxLength(2000),
        },
    }
}
const v$ = useVuelidate(rules, {newBasics, newEducation, newWork}) // add minlength

function addBasics() {
    v$.value.$reset();
    Object.keys(newBasics.value).forEach(el => newBasics.value[el] = null)
    basicsModalInstance.toggle();
}

async function submitBasics() {
    let result = await v$.value.newBasics.$validate()

    if (!result) {
        return;
    }

    v$.value.$reset();
    basics.value = {...newBasics.value};
    basicsModalInstance.toggle();
}

function editBasics() {
    isEditing.value = true;
    newBasics.value = {...basics.value};
    v$.value.newBasics.$validate()
    basicsModalInstance.toggle();
}

function deleteBasics() {
    Object.keys(basics.value).forEach(el => basics.value[el] = null)
}

function addEducation() {
    v$.value.$reset();
    educationModalInstance.toggle();
    isEditing.value = false;
    Object.keys(newEducation.value).forEach(el => newEducation.value[el] = null)
}

async function submitEducation() {
    let result = await v$.value.newEducation.$validate()

    if (!result) {
        return;
    }

    if (isEditing.value) {
        let index = educationList.value.findIndex(education => education.id === newEducation.value.id)
        let education = educationList.value[index]
        education.school = newEducation.value.school
        education.faculty = newEducation.value.faculty
        education.direction = newEducation.value.direction
        education.level = newEducation.value.level
        education.status = newEducation.value.status
        education.currentlyActive = newEducation.value.currentlyActive
        education.from = newEducation.value.from
        education.to = newEducation.value.to
    } else {
        educationList.value.push({
            id: newEducationId,
            school: newEducation.value.school,
            faculty: newEducation.value.faculty,
            direction: newEducation.value.direction,
            level: newEducation.value.level,
            status: newEducation.value.status,
            currentlyActive: newEducation.value.currentlyActive,
            from: newEducation.value.from,
            to: newEducation.value.to,
        });
        newEducationId++;
    }

    v$.value.$reset();
    sortListByDate(educationList.value)
    educationModalInstance.toggle();
}

async function editEducation(education) {
    isEditing.value = true;
    newEducation.value = {...education};
    let test = await v$.value.newEducation.$validate()
    educationModalInstance.toggle();
}

function deleteEducation() {
    let indexToRemove = educationList.value.findIndex(education => education.id === newEducation.value.id);
    if (indexToRemove !== -1) {
        educationList.value.splice(indexToRemove, 1);
    }
}

function addWork() {
    v$.value.$reset();
    workModalInstance.toggle();
    isEditing.value = false;
    Object.keys(newWork.value).forEach(el => newWork.value[el] = null)
}

async function submitWork() {
    let result = await v$.value.newWork.$validate()

    if (!result) {
        return;
    }

    if (isEditing.value) {
        let workIndex = workList.value.findIndex(work => work.id === newWork.value.id)
        let work = workList.value[workIndex]
        work.employer = newWork.value.employer
        work.position = newWork.value.position
        work.type = newWork.value.type
        work.currentlyActive = newWork.value.currentlyActive
        work.from = newWork.value.from
        work.to = newWork.value.to
        work.description = newWork.value.description
    } else {
        workList.value.push({
            id: newWorkId,
            employer: newWork.value.employer,
            position: newWork.value.position,
            type: newWork.value.type,
            currentlyActive: newWork.value.currentlyActive,
            from: newWork.value.from,
            to: newWork.value.to,
            description: newWork.value.description,
        });
        newWorkId++;
    }

    v$.value.$reset();
    sortListByDate(workList.value)
    workModalInstance.toggle();
}

function editWork(work) {
    isEditing.value = true;
    newWork.value = {...work};
    workModalInstance.toggle();
    v$.value.newWork.$validate()
}

function deleteWork() {
    let indexToRemove = workList.value.findIndex(work => work.id === newWork.value.id);
    workList.value[indexToRemove].deleted = true;
}

function saveResume() {
    let payload = {};
    payload.name = resumeName.value;
    if (Object.keys(basics.value).length > 0) {
        payload.basics = basics.value;
    }
    if (Object.keys(educationList.value).length > 0) {
        payload.education = educationList.value;
    }
    if (Object.keys(workList.value).length > 0) {
        payload.work = workList.value;
    }

    if (props.id) {
        axios.put('/api/resume/' + props.id, payload)
            .then((res) => {
                successMessage.show(res.data.message);
                setData()
            }).catch((err) => {
            showSectionErrors(err)
        })
    } else {
        axios.post('/api/resume', payload)
            .then((res) => {
                if (res.data.resume_id) {
                    successMessage.show(res.data.message)
                    setData(res.data.resume_id)
                    router.push('/resume/' + res.data.resume_id)
                }
            }).catch((err) => {
            showSectionErrors(err)
        })
    }
}

function deleteResumePrompt() {
    deleteModalInstance.toggle()
}

function deleteResume() {
    axios.delete('/api/resume/' + props.id)
        .then((res) => {
            successMessage.show(res.data.message)
            router.push('/resumes')
        }).catch((err) => {
        if (err.response.data.errors) {
            for (const property in err.response.data.errors) {
                err.response.data.errors[property].forEach((error) => {
                    errorMessage.show(error)
                })
            }
        } else if (err.response.data.message) {
            errorMessage.show(err.response.data.message)
        }
    })
    deleteModalInstance.toggle();
}

function showSectionErrors(err) {
    if (err.response.data.errors) {
        for (const property in err.response.data.errors) {
            err.response.data.errors[property].forEach((error) => {
                const removeSection = /\w+\.\d+\.\s*(\w+)/;
                errorMessage.show(error.replace(removeSection, '$1'))
            })
        }
    } else if (err.response.data.message) {
        errorMessage.show(err.response.data.message)
    }

    let sections = [
        ...new Set(
            Object.keys(err.response.data.errors).map(
                error => error.substring(0, error.lastIndexOf('.'))
            )
        )
    ];

    sections.forEach(function (sectionName) {
        sectionName = sectionName.split('.');
        let element;

        if (sectionName.length > 1) {
            let childIndex = sectionName[1] ? Number(sectionName[1]) + 1 : 1;

            element = document
                .getElementById(sectionName[0] + 'Section')
                .querySelector('li:nth-of-type(' + childIndex + ')');
        } else {
            element = document
                .getElementById(sectionName[0] + 'Section')

            if (sectionName[0] !== 'basics') {
                element = document
                    .querySelector('div:nth-of-type(1)')
            }
        }
        errorAnimation(element, 2000);
    })
}

function errorAnimation(element, ms) {
    element.classList.add("element-error-flash")
    setTimeout(() => {
        element.classList.remove("element-error-flash")
    }, ms)
}

function parseDate(dateString) {
    let [month, year] = dateString.split('/');
    return new Date(parseInt(year, 10), parseInt(month, 10) - 1);
}

function sortListByDate(list) {
    return list.sort(function (a, b) {
        let aHasTo = Boolean(a.to);
        let bHasTo = Boolean(b.to);

        if (aHasTo !== bHasTo) {
            return aHasTo ? 1 : -1;
        }

        return parseDate(b.from) - parseDate(a.from)
    })
}

function currentlyActiveCheckbox(element) {
    if (element.currentlyActive) {
        element.to = null
    }
}
</script>
