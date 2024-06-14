Cypress.on("uncaught:exception", (err, runnable) => {
    return false;
});

describe("reservation pasien testing", () => {
    beforeEach(() => {
        cy.visit("http://127.0.0.1:8000/login");

        cy.get('input[name="email"]').type("pasien@mail.com");
        cy.get('input[name="password"]').type("12345");
        cy.get("form").submit();

        cy.url().should("include", "/dashboard");
        cy.visit("http://127.0.0.1:8000/jadwal");
    });

    it("make an appointment invalid", () => {
        cy.get(".slide__content > .d-flex > .btn").click();
        cy.get(":nth-child(2) > .card > .card-body > form > .btn").click();
        cy.get("#schedule_date1").click();
        cy.get("#schedule_time1").click();
        cy.get("form > .btn").click();

        cy.get("#konfirmasi:invalid")
            .invoke("prop", "validationMessage")
            .should("contain", "Please tick this box if you want to proceed");

        cy.get('.btn-primary').click();
    })

    it("make an appointment valid", () => {
        cy.get(".slide__content > .d-flex > .btn").click();
        cy.get(":nth-child(2) > .card > .card-body > form > .btn").click();
        cy.get("#schedule_date1").click();
        cy.get("#schedule_time1").click();
        cy.get("form > .btn").click();

        cy.get("#konfirmasi").click();

        cy.get(".btn-primary").click();
        cy.get("#bukti_pembayaran").selectFile("D:/Assets/Icons/gradient.jpg");
        cy.get("#default-form > .text-center > .btn-primary").click();
        cy.contains("Menunggu Konfirmasi").should("exist");
    });
});
