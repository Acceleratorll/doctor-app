Cypress.on('uncaught:exception', (err, runnable) => {
    return false;
});

describe("see list jadwal", () => {
  before(() => {
      // Log in as a superadmin or doctor
      cy.visit("http://127.0.0.1:8000/login"); // Assuming your login page is located at /login

      cy.get('input[name="email"]').type("superadmin@mail.com"); // Replace with your email
      cy.get('input[name="password"]').type("12345");
      cy.get("form").submit();

      // Wait for authentication to complete
      cy.url().should("include", "/admin/dashboard"); // Assuming the dashboard page URL after login
  });
  
    it("passes", () => {
        cy.visit("http://127.0.0.1:8000/admin/jadwal");
    });

});

describe("create jadwal", () => {
  beforeEach(() => {
      // Log in as a superadmin or doctor
      cy.visit("http://127.0.0.1:8000/login"); // Assuming your login page is located at /login

      cy.get('input[name="email"]').type("superadmin@mail.com"); // Replace with your email
      cy.get('input[name="password"]').type("12345");
      cy.get("form").submit();

      // Wait for authentication to complete
      cy.url().should("include", "/admin/dashboard"); // Assuming the dashboard page URL after login
  });

    it("creates a jadwal valid", () => {
        // Visit the jadwal creation page
        cy.visit("http://127.0.0.1:8000/admin/jadwal/create");

        // Fill out the form fields
        cy.get('select[name="place_id"]').select("Cabang Citraland", {
            force: true,
        });

        cy.get('select[name="schedule_type_id"]').select(2); // Replace '1' with the desired schedule type ID
        cy.get('input[name="schedule_date"]').type("2024-06-08"); // Replace with the desired schedule date
        cy.get('input[name="schedule_time"]').type("09:00:00"); // Replace with the desired schedule time
        cy.get('input[name="schedule_time_end"]').type("17:00:00"); // Replace with the desired end time
        cy.get('select[name="employee_id"]').select(1); // Replace '1' with the desired schedule type ID
        cy.get('input[name="qty"]').type(1); // Replace with the desired quantity
        cy.get('select[name="frequency"]').select(1); // Replace '1' with the desired employee ID
        cy.get('input[name="duration"]').type(3); // Replace with the desired quantity

        // Submit the form
        cy.get("#jadwal").submit();

        // Assert that the jadwal is created successfully
        cy.url().should("include", "/admin/jadwal"); // Assert that the URL redirects to the jadwal list page
        cy.contains("Jadwal created successfully").should("exist"); // Assert that a success message is displayed
    });

    it("creates a jadwal invalid", () => {
        // Visit the jadwal creation page
        cy.visit("http://127.0.0.1:8000/admin/jadwal/create");

        // Fill out the form fields
        cy.get('select[name="place_id"]').select("Cabang Citraland", {
            force: true,
        });

        cy.get('select[name="schedule_type_id"]').select(2); // Replace '1' with the desired schedule type ID
        cy.get('input[name="schedule_date"]').type("2024-06-08"); // Replace with the desired schedule date
        // cy.get('select[name="employee_id"]').select(1); // Replace '1' with the desired schedule type ID
        cy.get('input[name="schedule_time"]').type("09:00:00"); // Replace with the desired schedule time
        cy.get('input[name="schedule_time_end"]').type("17:00:00"); // Replace with the desired end time
        cy.get('input[name="qty"]').type(1); // Replace with the desired quantity
        cy.get('select[name="frequency"]').select(1); // Replace '1' with the desired employee ID
        cy.get('input[name="duration"]').type(3); // Replace with the desired quantity

        // Submit the form
        cy.get("#jadwal").submit();

        cy.contains("Kolom Employee harus diisi.").should("exist"); // Assert that a success message is displayed
    });
});

describe("edit jadwal", () => {
  beforeEach(() => {
      // Log in as a superadmin or doctor
      cy.visit("http://127.0.0.1:8000/login"); // Assuming your login page is located at /login

      cy.get('input[name="email"]').type("superadmin@mail.com"); // Replace with your email
      cy.get('input[name="password"]').type("12345");
      cy.get("form").submit();

      // Wait for authentication to complete
      cy.url().should("include", "/admin/dashboard"); // Assuming the dashboard page URL after login
  });

    it("edit a jadwal valid", () => {
        // Visit the jadwal creation page
        cy.visit("http://127.0.0.1:8000/admin/jadwal/1/edit");

        // Fill out the form fields
        cy.get('select[name="place_id"]').select(1);

        cy.get('select[name="schedule_type_id"]').select(2);
        cy.get('input[name="schedule_date"]').type("2024-06-08"); // Replace with the desired schedule date
        cy.get('input[name="schedule_time"]').type("09:00:00"); // Replace with the desired schedule time
        cy.get('input[name="schedule_time_end"]').type("17:00:00"); // Replace with the desired end time
        cy.get('input[name="qty"]').clear().type(11); // Replace with the desired end time

        // Submit the form
        cy.get("#jadwal").submit();

        // Assert that the jadwal is created successfully
        cy.url().should("include", "/admin/jadwal"); // Assert that the URL redirects to the jadwal list page
        cy.contains("Jadwal updated successfully").should("exist"); // Assert that a success message is displayed
    });

    it("edit a jadwal invalid", () => {
        // Visit the jadwal creation page
        cy.visit("http://127.0.0.1:8000/admin/jadwal/1/edit");

        // Fill out the form fields
        cy.get('select[name="place_id"]').select(1);

        cy.get('select[name="schedule_type_id"]').select(2);
        cy.get('input[name="schedule_date"]').type("2024-06-08"); // Replace with the desired schedule date
        cy.get('input[name="schedule_time"]').type("09:00:00"); // Replace with the desired schedule time
        cy.get('input[name="schedule_time_end"]').type("17:00:00"); // Replace with the desired end time
        cy.get('input[name="qty"]').clear();

        // Submit the form
        cy.get("#jadwal").submit();

        cy.contains("Kolom Kuota harus diisi.").should("exist"); // Assert that a success message is displayed
    });
});

describe("delete jadwal", () => {
  beforeEach(() => {
      // Log in as a superadmin or doctor
      cy.visit("http://127.0.0.1:8000/login"); // Assuming your login page is located at /login

      cy.get('input[name="email"]').type("superadmin@mail.com"); // Replace with your email
      cy.get('input[name="password"]').type("12345");
      cy.get("form").submit();

      // Wait for authentication to complete
      cy.url().should("include", "/admin/dashboard"); // Assuming the dashboard page URL after login
  });

    it("delete a jadwal valid", () => {
        cy.visit("http://127.0.0.1:8000/admin/jadwal");
        cy.get(":nth-child(4) > .project-actions > #delete").click();

        cy.contains("Are you sure you want to delete this schedule?").should(
            "exist"
        );
        cy.get(".swal2-confirm").click();
        cy.contains("Jadwal deleted successfully").should(
            "exist"
        );
    });

    it("delete a jadwal cancel", () => {
        cy.visit("http://127.0.0.1:8000/admin/jadwal");
        cy.get(":nth-child(4) > .project-actions > #delete").click();

        cy.contains("Are you sure you want to delete this schedule?").should(
            "exist"
        );
        cy.get(".swal2-cancel").click();
    });
});