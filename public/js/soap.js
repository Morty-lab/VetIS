services = []

//fillbles
//soapType , status

function selectVeterinarian(vet){
    console.log(vet)
    let vetDisplay = document.getElementById('vet')
    vetDisplay.textContent = `${vet['firstname']} ${vet['lastname']}`
}

function fillTemplate(textarea){
    const examinationTemplateContent = `
    Heart Rate (BPM):
    Respiration Rate (BRPM):
    Weight (KG):
    Length (CM):
    CRT:
    BCS:
    Lymph Nodes:
    Palpebral Reflex:
    Temperature:

    `;

    const diagnosisTemplateContent = `
        Heart Rate (BPM):
        Differential Diagnosis:
        Notes:
        Test Results:
        Final Diagnosis:
        Prognosis:
        Category:`;

    if(textarea == 'examination'){
        const examinationTextarea = document.querySelector('textarea[name="examination"]');
        examinationTextarea.value = examinationTemplateContent;
    }

    if(textarea == 'diagnosis'){
        const diagnosisTextarea = document.querySelector('textarea[name="diagnosis"]');
        diagnosisTextarea.value = diagnosisTemplateContent
    }

    // Set the textarea content
}

function fillDiagnosisTemplate(){

}

function addLaboratory(){

}

function removeLaboratory(){

}
