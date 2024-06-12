Cypress.on("uncaught:exception", (err, runnable) => {
    return false;
});

describe('pasien testing', () => {
  beforeEach(() => {
      cy.visit("http://127.0.0.1:8000/login");

      cy.get('input[name="email"]').type("pasien@mail.com");
      cy.get('input[name="password"]').type("12345");
      cy.get("form").submit();

      cy.get("#profileDropdown").click();
      cy.get('[href="/profile"]').click();
  });

  // it('see pasien profile and reservation', () => {
  //     cy.contains('Rekam Medis').should('exist');
  //     cy.contains('Reservasi').should('exist');
  // });

  // it('set pasien pin', () => {
  //     cy.contains('Set PIN')
  //     cy.get(":nth-child(2) > .btn").click();
  //     cy.get("#swal2-input").type("1234");
  //     cy.get(".swal2-confirm").click();
  // });

  // it('see pasien rekam medis', () => {
  //     cy.get("#medical-records-container > .btn").click();
  //     cy.get("input[name='access_code']").type("1234");
  //     cy.get("form > .btn").click();
  //     cy.contains("Access code match").should("exist");
  //     cy.contains("Dokter:").should("exist");
  // });
  
  // it("download pasien rekam medis file", () => {
  //     cy.get("#medical-records-container > .btn").click();
  //     cy.get("input[name='access_code']").type("1234");
  //     cy.get("form > .btn").click();
  //     cy.contains("Access code match").should("exist");
  //     cy.contains("Dokter:").should("exist");
  //     cy.get(":nth-child(1) > .card-body > .float-right > .btn").click({ force:true });
  // });

  // it("edit pasien profile valid", () => {
  //   cy.get(":nth-child(1) > .btn").click();
  //   cy.get(":nth-child(1) > .col-sm-9 > .form-control").clear().type('Original Pasien');
  //   cy.get(".btn-primary").click();
  //   cy.contains("Original Pasien").should('exist');
  // });
  
  // it("edit pasien profile invalid", () => {
  //   cy.get(":nth-child(1) > .btn").click();
  //   cy.get("input[name='name']").clear();
  //   cy.get(".btn-primary").click();
  //   cy.url("http://127.0.0.1:8000/profile/1/edit");
  // });

  // it("edit pin pasien valid", () => {
  //   cy.get(":nth-child(17) > :nth-child(2) > .btn").click();
  //   cy.get("#currentPin").type("1234");
  //   cy.get("#newPin").type("1111");
  //   cy.get("#confirmPin").type("1111");
  //   cy.get(".swal2-confirm").click();
  //   cy.contains("Pin registered").should("exist");
  // });

  // it("edit pin pasien valid", () => {
  //   cy.get(":nth-child(17) > :nth-child(2) > .btn").click();
  //   cy.get("#currentPin").type("1111");
  //   cy.get("#newPin").type("1111");
  //   cy.get("#confirmPin").type("1111");
  //   cy.get(".swal2-confirm").click();
  //   cy.contains("PIN Salah").should("exist");
  // });

  it("see jadwal", () => {
    cy.visit("http://127.0.0.1:8000/jadwal");
    cy.get(":nth-child(1) > .contact-box > .contact__content > .btn > span").click();
  });

  
})