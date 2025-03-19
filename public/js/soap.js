services = [];

//fillbles
//soapType , status

function addService(service) {
    const jsonString = JSON.stringify(service);
    const form = document.getElementById("serviceForm");

    const hiddenInput = document.createElement("input");
    hiddenInput.type = "hidden";
    hiddenInput.name = "service";
    hiddenInput.value = jsonString;

    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}
function selectVeterinarian(vet) {
    let vetDisplay = document.getElementById("vet");
    let vetInput = document.getElementById("vetInput");
    vetDisplay.textContent = `${vet["firstname"]} ${vet["lastname"]}`;
    vetInput.value = vet["id"];

    const modal = bootstrap.Modal.getInstance(
        document.getElementById("veterinarianListModal")
    );
    modal.hide();
}

function fillSoapTypeValue() {
    let soapType = document.getElementById("soapType");
    let soapTypeInput = document.getElementById("soapTypeInput");
    var text = soapType.innerText;
    soapTypeInput.value = text;
}

function fillSoapStatusValue() {
    let soapStatus = document.getElementById("dropdownMenuButton");
    let soapStatusInput = document.getElementById("statusInput");

    var text = soapStatus.innerText;
    soapStatusInput.value = text;
}
function fillTemplate(textarea) {
    const examinationTemplateContent = `
        <h4><strong>Heart Rate: </strong></h4>
        <h4><strong>Respiration Rate:</strong></h4>
        <h4><strong>Weight:</strong></h4>
        <h4><strong>Length:</strong></h4>
        <h4><strong>CRT:</strong></h4>
        <h4><strong>BCS:</strong></h4>
        <h4><strong>Lymph Nodes:</strong></h4>
        <h4><strong>Palpebral Reflex:</strong></h4>
        <h4><strong>Temperature:</strong></h4>
    `;

    const diagnosisTemplateContent = `
        Heart Rate:
        Differential Diagnosis:
        Notes:
        Test Results:
        Final Diagnosis:
        Prognosis:
        Category:`;

    if (textarea == "examination") {
        const examinationTextarea = document.querySelector(
            'textarea[name="examination"]'
        );
        examination.clipboard.dangerouslyPasteHTML(examinationTemplateContent);
    }

    if (textarea == "diagnosis") {
        const diagnosisTextarea = document.querySelector(
            'textarea[name="diagnosis"]'
        );
        diagnosisTextarea.value = diagnosisTemplateContent;
    }

    // Set the textarea content
}

function submitTextFields() {
    const updateForm = document.getElementById("updateForm");

    // Define your custom data
    let customData = {
        examination: document.getElementById("examinationTextArea").value,
        interpretation: document.getElementById("interpretationTextField")
            .value,
        diagnosis: document.getElementById("diagnosisTextArea").value,
        treatment: document.getElementById("treatmentTextArea").value,
        prescription: document.getElementById("treatmentTextArea").value,
        client_communication: document.getElementById(
            "clientCommunicationTextArea"
        ).value,
    };

    for (let key in customData) {
        let formfield = document.getElementById(key);
        formfield.value = customData[key];
    }

    updateForm.submit();
}

function fillDiagnosisTemplate() {}

function addLaboratory() {}

function removeLaboratory() {}
