
document.getElementById("download").addEventListener("click", function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
  
   
    const courseCode = document.getElementById("preview-code").value.trim() || "N/A";
    const courseTitle = document.getElementById("preview-title").value.trim() || "N/A";
    const stream = document.getElementById("preview-stream").value.trim() || "N/A";
  
    // Set initial y-position and add course info
    let y = 20;
    doc.setFont("helvetica", "bold");
    doc.setFontSize(18);
    doc.text(`Course Code: ${courseCode}`, 15, y);
    y += 10;
    doc.text(`Course Title: ${courseTitle}`, 15, y);
    y += 10;
    doc.text(`Stream: ${stream}`, 15, y);
    y += 15;
  
    
    const units = document.querySelectorAll("#preview-units > div");
    
    if (units.length === 0) {
      doc.setFontSize(12);
      doc.text("No units available.", 15, y);
    } else {
      units.forEach((unit, index) => {
        const unitNameInput = unit.querySelector("input");
        const topicsTextarea = unit.querySelector("textarea");
  
        const unitName = unitNameInput ? unitNameInput.value.trim() : `Unit ${index + 1}`;
        const topics = topicsTextarea ? topicsTextarea.value.trim() : "No topics provided.";
  
        
        doc.setFont("helvetica", "bold");
        doc.setFontSize(14);
        doc.text(`Unit ${index + 1}: ${unitName}`, 15, y);
        y += 8;
  
       
        doc.setFont("helvetica", "normal");
        doc.setFontSize(12);
        const splitTopics = doc.splitTextToSize(topics, 180);
        doc.text(splitTopics, 15, y);
        y += (splitTopics.length * 7) + 8;
  
        
        if (y > 270) {
          doc.addPage();
          y = 20;
        }
      });
    }
  
    
    doc.save(`${courseTitle.replace(/\s+/g, "_")}_Syllabus.pdf`);
  });
  
  // PDF Upload Functionality (improved version)
  document.getElementById("upload").addEventListener("click", async function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
  
    // Get form data
    const courseCode = document.getElementById("preview-code").value.trim() || "N/A";
    const courseTitle = document.getElementById("preview-title").value.trim() || "N/A";
    const stream = document.getElementById("preview-stream").value.trim() || "N/A";
  
    // Add content to PDF (SAME AS DOWNLOAD FUNCTION)
    let y = 20;
    doc.setFont("helvetica", "bold");
    doc.setFontSize(18);
    doc.text(`Course Code: ${courseCode}`, 15, y);
    y += 10;
    doc.text(`Course Title: ${courseTitle}`, 15, y);
    y += 10;
    doc.text(`Stream: ${stream}`, 15, y);
    y += 15;
  
    // ADD UNITS/TOPICS SECTION (MISSING IN YOUR ORIGINAL UPLOAD)
    const units = document.querySelectorAll("#preview-units > div");
    
    if (units.length === 0) {
      doc.setFontSize(12);
      doc.text("No units available.", 15, y);
    } else {
      units.forEach((unit, index) => {
        const unitNameInput = unit.querySelector("input");
        const topicsTextarea = unit.querySelector("textarea");
  
        const unitName = unitNameInput ? unitNameInput.value.trim() : `Unit ${index + 1}`;
        const topics = topicsTextarea ? topicsTextarea.value.trim() : "No topics provided.";
  
        doc.setFont("helvetica", "bold");
        doc.setFontSize(14);
        doc.text(`Unit ${index + 1}: ${unitName}`, 15, y);
        y += 8;
  
        doc.setFont("helvetica", "normal");
        doc.setFontSize(12);
        const splitTopics = doc.splitTextToSize(topics, 180);
        doc.text(splitTopics, 15, y);
        y += (splitTopics.length * 7) + 8;
  
        if (y > 270) {
          doc.addPage();
          y = 20;
        }
      });
    }
  
    // Convert to blob
    const pdfBlob = doc.output("blob");
    const filename = `${courseTitle.replace(/\s+/g, "_")}_Syllabus.pdf`;
  
    // Rest of your upload code remains the same...
    const formData = new FormData();
    formData.append("pdf", pdfBlob, filename);
  
    const uploadBtn = document.getElementById("upload");
    uploadBtn.disabled = true;
    uploadBtn.textContent = "Uploading...";
  
    try {
      const response = await fetch("upload.php", {
        method: "POST",
        body: formData,
      });
  
      const result = await response.json();
      if (response.ok) {
        alert("Uploaded successfully:\n" + filename);
      } else {
        throw new Error(result.message || "Upload failed");
      }
    } catch (err) {
      alert("Upload failed: " + err.message);
    } finally {
      uploadBtn.disabled = false;
      uploadBtn.textContent = "Upload";
    }
});
  
  