using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using LibroVirtual.Models;
using LibroVirtual.Data;
using Microsoft.EntityFrameworkCore;

namespace LibroVirtual.Controllers
{
    public class CursosController : Controller
    {
        private readonly LibroContext _context;

        public CursosController(LibroContext context)
        {
            _context = context;
        }

        public async Task<IActionResult> Index()
        {
            return View(await _context.Curso.ToListAsync());
        }
        public IActionResult Create()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("Nivel,Nombre,Letra,Anio")] Curso curso)
        {
            if (ModelState.IsValid)
            {
                _context.Add(curso);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }

            return View(curso);
        }

        public async Task<String> CrearCurso(int nivel, string nombre, string letra, int anio)
        {
            Curso curso = new Curso(nivel, nombre, letra, anio);
            _context.Add(curso);
            await _context.SaveChangesAsync();

            return "Create";
        }

        public async Task<List<Curso>> EditAjax(int id)
        {
            List<Curso> cursos = new List<Curso>();
            var curso = await _context.Curso.SingleOrDefaultAsync(m => m.Id == id);
            cursos.Add(curso);
            return cursos;
        }

        public async Task<String> EditCursoAjax(int id, int nivel, string nombre, string letra, int anio)
        {
            Curso curso = new Curso(id, nivel , nombre, letra, anio);
            _context.Update(curso);
            await _context.SaveChangesAsync();
            return "Save";
        }

        public async Task<String> EliminarCurso(int id)
        {
            var curso = await _context.Curso.FindAsync(id);
            _context.Curso.Remove(curso);
            await _context.SaveChangesAsync();
            return "Delete";
        }
    }
}