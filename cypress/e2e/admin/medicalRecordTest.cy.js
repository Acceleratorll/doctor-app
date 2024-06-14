Cypress.on("uncaught:exception", (err, runnable) => {
    return false;
});

describe("rekam medis", () => {
    beforeEach(() => {
        // Log in as a superadmin or doctor
        cy.visit("http://127.0.0.1:8000/login"); // Assuming your login page is located at /login

        cy.get('input[name="email"]').type("superadmin@mail.com"); // Replace with your email
        cy.get('input[name="password"]').type("12345");
        cy.get("form").submit();

        // Wait for authentication to complete
        cy.url().should("include", "/admin/dashboard"); // Assuming the dashboard page URL after login
    });

    it("isi rekam medis umum valid", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservation");
        cy.get(
            ':nth-child(1) > .project-actions > .d-flex > [action="/admin/medis/create"] > .btn'
        ).click();

        cy.get("select[name='icd_code']").then((select) => {
            // Open the select2 dropdown
            cy.wrap(select).parent().find(".select2-selection").click();

            cy.get(".select2-search__field").type("A");
            cy.get('[data-select2-id="13"]').click();

            cy.get('#files').selectFile(['D:/Assets/Icons/unnamed.png', 'D:/Assets/Icons/bank-building.png']);
            cy.get('#complaint').type("Complaint");
            cy.get('#physical_exam').type("Physical Exam");
            cy.get('#diagnosis').type("Diagnosis");
            cy.get('#recommendation').type("Recommendation");
            cy.get('#recipe').type("Recipe");
            cy.get('#action').type("Action");
            cy.get('#hasiltes').type("Description");
            cy.get(".btn-primary").click();

            cy.contains(
                "Rekam Medis berhasil Ditambahkan"
            ).should("exist");
        });
    });

    it("isi rekam medis umum invalid", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservation");
        cy.get(
            ':nth-child(1) > .project-actions > .d-flex > [action="/admin/medis/create"] > .btn'
        ).click();
        
        cy.get("#complaint:invalid")
            .invoke("prop", "validationMessage")
            .should("equal", "Please fill in this field.");

        cy.get("#physical_exam:invalid")
            .invoke("prop", "validationMessage")
            .should("equal", "Please fill in this field.");

        cy.get("#diagnosis:invalid")
            .invoke("prop", "validationMessage")
            .should("equal", "Please fill in this field.");

        cy.get("#recommendation:invalid")
            .invoke("prop", "validationMessage")
            .should("equal", "Please fill in this field.");

        cy.get("#recipe:invalid")
            .invoke("prop", "validationMessage")
            .should("equal", "Please fill in this field.");

        cy.get("#action:invalid")
            .invoke("prop", "validationMessage")
            .should("equal", "Please fill in this field.");
    });

    it("isi rekam medis gigi beserta odontogram", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservasi/gigi");
        cy.get(
            ':nth-child(1) > .project-actions > .d-flex > [action="/admin/medis/create"] > .btn'
        ).click();

        cy.get("select[name='icd_code']").then((select) => {
            // Open the select2 dropdown
            cy.wrap(select).parent().find(".select2-selection").click();

            cy.get(".select2-search__field").type("A");
            cy.get('[data-select2-id="13"]').click();

            cy.get('#files').selectFile(['D:/Assets/Icons/unnamed.png', 'D:/Assets/Icons/bank-building.png']);
            cy.get('#complaint').type("Complaint");
            cy.get('#physical_exam').type("Physical Exam");
            cy.get('#diagnosis').type("Diagnosis");
            cy.get('#recommendation').type("Recommendation");
            cy.get('#recipe').type("Recipe");
            cy.get('#action').type("Action");
            cy.get('#hasiltes').type("Description");
            cy.get(".btn-primary").click();
        });

        cy.get(
            ":nth-child(1) > :nth-child(1) > .select2 > .selection > .select2-selection > .select2-selection__rendered > .select2-selection__clear"
        ).click();

        cy.get(".content > :nth-child(1)").click();

        cy.get(
            ":nth-child(1) > :nth-child(2) > .select2 > .selection > .select2-selection > .select2-selection__rendered"
        ).click();

        cy.get(
            ":nth-child(1) > :nth-child(1) > .select2 > .selection > .select2-selection > .select2-selection__rendered > .select2-search > .select2-search__field"
        ).type('M');

        cy.get(".select2-results__option").contains("M").click();

        cy.get(
            ":nth-child(1) > :nth-child(1) > .select2 > .selection > .select2-selection > .select2-selection__rendered > .select2-search > .select2-search__field"
        ).type('ano');

        cy.get(".select2-results__option").contains("ano").click();

        cy.get(".col > .btn-primary").click();
        cy.get(".col > .btn-primary").click();

        cy.contains("Medical record and odontogram created successfully").should('exist');
    });

    it("edit rekam medis umum", () => {
        cy.visit("http://127.0.0.1:8000/admin/medis");
        
        cy.get(":nth-child(1) > .project-actions > form > .btn-warning").click();

        cy.get("select[name='icd_code']").then((select) => {
            cy.wrap(select).parent().find(".select2-selection").click();

            cy.get(".select2-search__field").type("A");
            cy.get('[data-select2-id="13"]').click();
        });
        
        cy.get('#files').selectFile(['D:/Assets/Icons/unnamed.png', 'D:/Assets/Icons/bank-building.png']);
        cy.get('#complaint').clear().type("Complaint");
        cy.get("#physical_exam").clear().type("Physical Exam");
        cy.get("#diagnosis").clear().type("Diagnosis");
        cy.get("#recommendation").clear().type("Recommendation");
        cy.get("#recipe").clear().type("Recipe");
        cy.get("#action").clear().type("Action");
        cy.get("#hasiltes").clear().type("Description");
        cy.get(".btn-primary").click();

        cy.contains("Rekam medis berhasil diupdate").should('exist');
    });
    
    it("edit odontogram", () => {
        cy.visit("http://127.0.0.1:8000/admin/rme/gigi/index");
        
        cy.get(".odd > .project-actions > .d-flex > .btn-warning").click();

        cy.get(
            ":nth-child(1) > :nth-child(1) > .select2 > .selection > .select2-selection > .select2-selection__rendered > .select2-selection__clear"
        ).click();
        cy.get(".content > :nth-child(1)").click();
        cy.get(
            ":nth-child(1) > :nth-child(1) > .select2 > .selection > .select2-selection > .select2-selection__rendered"
        ).click();
        cy.get(
            ":nth-child(1) > :nth-child(1) > .select2 > .selection > .select2-selection > .select2-selection__rendered > .select2-search > .select2-search__field"
        ).type("sou");
        cy.get(".select2-results__option").contains("sou").click();

        cy.get(
            ":nth-child(1) > :nth-child(15) > .select2 > .selection > .select2-selection > .select2-selection__rendered > .select2-selection__clear"
        ).click();
        cy.get(".content > :nth-child(1)").click();
        cy.get(
            ":nth-child(1) > :nth-child(15) > .select2 > .selection > .select2-selection > .select2-selection__rendered"
        ).click();
        cy.get(
            ":nth-child(1) > :nth-child(15) > .select2 > .selection > .select2-selection > .select2-selection__rendered > .select2-search > .select2-search__field"
        ).type('M');
        cy.get(".select2-results__option").contains("M").click();
        cy.get(
            ":nth-child(1) > :nth-child(15) > .select2 > .selection > .select2-selection > .select2-selection__rendered > .select2-search > .select2-search__field"
        ).type('ano');
        cy.get(".select2-results__option").contains("ano").click();

        cy.get(
            ":nth-child(4) > :nth-child(15) > .select2 > .selection > .select2-selection > .select2-selection__rendered > .select2-selection__clear"
        ).click();
        cy.get(".content > :nth-child(1)").click();
        cy.get(
            ":nth-child(4) > :nth-child(15) > .select2 > .selection > .select2-selection > .select2-selection__rendered"
        ).click();
        cy.get(
            ":nth-child(4) > :nth-child(15) > .select2 > .selection > .select2-selection > .select2-selection__rendered > .select2-search > .select2-search__field"
        ).type('O');
        cy.get(".select2-results__option").contains("O").click();
        cy.get(
            ":nth-child(4) > :nth-child(15) > .select2 > .selection > .select2-selection > .select2-selection__rendered > .select2-search > .select2-search__field"
        ).type('dia');
        cy.get(".select2-results__option").contains("dia").click();

        cy.get("select[name='occlusi']").select(2);
        cy.get("select[name='torus_palatinus']").select(2);
        cy.get("select[name='torus_mandibularis']").select(2);
        cy.get("select[name='palatum']").select(2);

        cy.get("#diastema").type("37 peg shape");
        cy.get("#anomali").type("17 peg shape");
        cy.get("#others").type("17 peg shape, 37 peg shape");

        cy.get(".btn-primary").click();

        cy.contains(
            "Medical record and odontogram updated successfully"
        ).should("exist");
    });

    it("delete rekam medis", () => {
        cy.visit("http://127.0.0.1:8000/admin/medis");
        cy.get(":nth-child(1) > .project-actions > form > .btn-danger").click();
        cy.contains("Rekam medis deleted successfully").should("exist");
    });

    it("delete odontogram", () => {
        cy.visit("http://127.0.0.1:8000/admin/rme/gigi/index");
        cy.get("form > .btn").click();
        cy.contains("Odontogram deleted successfully").should("exist");
    });
});
