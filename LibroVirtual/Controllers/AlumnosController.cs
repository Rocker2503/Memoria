using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.EntityFrameworkCore;
using LibroVirtual.Data;
using LibroVirtual.Models;
using Microsoft.AspNetCore.Mvc;

namespace LibroVirtual.Controllers
{
    
    public class AlumnosController : Controller
    {
        private readonly LibroContext _context;

        public AlumnosController(LibroContext context)
        {
            _context = context;
        }
        public async Task<IActionResult> Index(int id)
        {
            return View(await _context.Alumno.Where(m => m.RefCurso == id).ToListAsync());
        }

        public IActionResult Create()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("Id,ApellidoPaterno,ApellidoMaterno,Nombres,Sexo,FechaNacimiento,Direccion,Comuna,Procedencia,RefCurso")] Alumno alumno)
        {
            if (ModelState.IsValid)
            {
                _context.Add(alumno);
                await _context.SaveChangesAsync();
                var refcurso = alumno.RefCurso;
                int RefCurso = Convert.ToInt32(refcurso);
                return RedirectToAction("Index", new { idCurso = RefCurso });
            }
            return View(alumno);
        }

        public async Task<List<Alumno>> EditAjax(string id)
        {
            List<Alumno> alumnos = new List<Alumno>();
            var alumno = await _context.Alumno.SingleOrDefaultAsync(m => m.Id == id);
            alumnos.Add(alumno);
            return alumnos;
        }

        public async Task<String> EditAlumnoAjax(string id, string apellidoPaterno, string apellidoMaterno, string nombres, string sexo, DateTime fechaNacimiento, string direccion, string comuna, string procedencia, int refcurso)
        {
            Alumno alumno = new Alumno(id, apellidoPaterno, apellidoMaterno, nombres, sexo, fechaNacimiento, direccion, comuna, procedencia, refcurso);
            _context.Update(alumno);
            await _context.SaveChangesAsync();
            return "Save";
        }

        public async Task<String> EliminarAlumno(string id)
        {
            var alumno = await _context.Alumno.FindAsync(id);
            _context.Remove(alumno);
            await _context.SaveChangesAsync();
            return "Delete";
        }
    }
}