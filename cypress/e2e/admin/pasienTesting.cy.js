Cypress.on("uncaught:exception", (err, runnable) => {
    return false;
});

describe("pasien testing", () => {
    beforeEach(() => {
        cy.visit("http://127.0.0.1:8000/login");

        cy.get('input[name="email"]').type("superadmin@mail.com");
        cy.get('input[name="password"]').type("12345");
        cy.get("form").submit();

        cy.url().should("include", "/admin/dashboard");
        cy.visit("http://127.0.0.1:8000/admin/pasien");
    });

    it("see list of pasien", () => {
      cy.contains("Nama Pasien").should("exist");
    });

    it("add new pasien valid", () => {
      cy.get(".button-action > .btn").click();
      cy.get('#namapasien').type("Pasien Baru");
      cy.get('#tanggallahir').type("2000-01-01");
      cy.get(':nth-child(4) > .form-control').select(1);
      cy.get('#email').type("pasienBaru@mail.com");
      cy.get('#alamat').type("Jl. Pasien Baru");
      cy.get(':nth-child(7) > .col > .form-group > #nomorhandphone').type("081234567890");
      cy.get(':nth-child(8) > .col > .form-group > #nomorhandphone').type("80");
      cy.get(':nth-child(9) > .col > .form-group > #nomorhandphone').type('200');
      cy.get('#username').type("PasienBaru");
      cy.get('#password').type('12345');
      cy.get('.btn-primary').click();
      cy.contains('Patient created successfully').should('exist');
    });

    it("add new pasien invalid empty input", () => {
      cy.get(".button-action > .btn").click();
      cy.get("#namapasien:invalid")
          .invoke("prop", "validationMessage")
          .should("contain", "Please fill in this field");;
    });

    it("add new pasien invalid tanggal lahir more than today", () => {
      cy.get(".button-action > .btn").click();
          cy.get("#tanggallahir").type("2025-05-05");
        cy.get(".btn-primary").click();
        cy.contains("Tanggal lahir tidak boleh lebih dari hari ini").should(
            "exist"
        );
    });

    it("add new pasien invalid same email", () => {
        cy.get(".button-action > .btn").click();
          cy.get('#namapasien').type("Pasien Baru");
          cy.get('#tanggallahir').type("2000-01-01");
          cy.get(':nth-child(4) > .form-control').select(1);
          cy.get('#email').type("pasienBaru@mail.com");
          cy.get('#alamat').type("Jl. Pasien Baru");
          cy.get(':nth-child(7) > .col > .form-group > #nomorhandphone').type("081234567890");
          cy.get(':nth-child(8) > .col > .form-group > #nomorhandphone').type("80");
          cy.get(':nth-child(9) > .col > .form-group > #nomorhandphone').type('200');
          cy.get('#username').type("PasienBaru");
          cy.get('#password').type('12345');
          cy.get('.btn-primary').click();
          cy.contains("The email has already been registered").should("exist");
    });

    it("edit pasien valid", () => {
        cy.get(
            ":nth-child(1) > .project-actions > form > .btn-warning"
        ).click();
        cy.get("#namapasien").clear().type("Pasien Lama");
        cy.get("#tanggallahir").type("2000-05-05");
        cy.get('.btn-primary').click();
        cy.contains("Patient updated successfully").should("exist");
    });

    it("edit pasien tanggal lahir more than today", () => {
        cy.get(
            ":nth-child(1) > .project-actions > form > .btn-warning"
        ).click();
        cy.get("#tanggallahir").type("2025-05-05");
        cy.get('.btn-primary').click();
        cy.contains(
            "Tanggal lahir tidak boleh lebih dari hari ini"
        ).should("exist");
    });

    it("delete pasien", () => {
        cy.get(":nth-child(1) > .project-actions > form > .btn-danger").click();
        cy.contains(
            "Patient successfully deleted"
        ).should("exist");
    });

    it("see pasien reservation", () => {
      cy.get(":nth-child(1) > .project-actions > form > .show-reservations").click();
        cy.contains(
            "Dokter"
        ).should("exist");
    });
});
