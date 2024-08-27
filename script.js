// Sample projects
const projects = [
    { id: 1, name: 'Project 1', description: 'Description 1', type: 'Research', documents: [] },
    { id: 2, name: 'Project 2', description: 'Description 2', type: 'Company', documents: [] },
    // Add more projects as needed
  ];
  
  // DOM elements
  const projectListElement = document.getElementById('project-list');
  const projectDetailsElement = document.getElementById('project-details');
  const projectInfoElement = document.getElementById('project-info');
  const documentListElement = document.getElementById('document-list');
  const newProjectForm = document.getElementById('newProjectForm');
  const uploadDocumentForm = document.getElementById('uploadDocumentForm');
  
  // Initialize project list
  function initializeProjectList() {
    projectListElement.innerHTML = projects.map(project =>
      `<li class="list-group-item" onclick="showProjectDetails(${project.id})">${project.name}</li>`
    ).join('');
  }
  
  // Show project details
  function showProjectDetails(projectId) {
    const selectedProject = projects.find(project => project.id === projectId);
    projectInfoElement.innerHTML = `<label>Project Name: ${selectedProject.name}</label>`;
    showDocumentList(selectedProject);
  }
  
  // Show document list
  function showDocumentList(project) {
    documentListElement.innerHTML = `<h4>List of Documents</h4>
      <ul>${project.documents.map(doc => `<li>${doc}</li>`).join('')}</ul>`;
  }
  
  // Show upload document modal
  function showUploadDocumentModal() {
    $('#uploadDocumentModal').modal('show');
  }
  
  // Event listeners
  newProjectForm.addEventListener('submit', function (event) {
    event.preventDefault();
    const projectName = document.getElementById('projectName').value;
    const description = document.getElementById('description').value;
    const projectType = document.querySelector('input[name="projectType"]:checked').value;
  
    const newProject = {
      id: projects.length + 1,
      name: projectName,
      description: description,
      type: projectType,
      documents: [],
    };
  
    projects.push(newProject);
    initializeProjectList();
    $('#newProjectModal').modal('hide');
  });
  
  uploadDocumentForm.addEventListener('submit', function (event) {
    event.preventDefault();
    const documentFiles = document.getElementById('documentFiles').files;
  
    // Upload logic (can be implemented as needed)
  
    $('#uploadDocumentModal').modal('hide');
  });
  
  // Initialize the project list on page load
  document.addEventListener('DOMContentLoaded', function () {
    initializeProjectList();
  });
  