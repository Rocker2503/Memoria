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
    public class AsignaturasController : Controller
    {
        private readonly LibroContext _context;

        public AsignaturasController(LibroContext context)
        {
            _context = context;
        }

        public async Task<IActionResult> Index(int id)
        {
            return View(await _context.Asignatura.Where(m => m.RefCurso == id).ToListAsync());
        }

        public IActionResult Create(int refcurso)
        {
            ViewBag.refCurso = refcurso;
            return View();
        }
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("Nombre,HorasSemanales,RefCurso")] Asignatura asignatura)
        {
            if(ModelState.IsValid)
            {
                _context.Add(asignatura);
                await _context.SaveChangesAsync();
                var refcurso = asignatura.RefCurso;
                int id = Convert.ToInt32(refcurso);
                return RedirectToAction("Index", new { id = id });
            }
            return View(asignatura);
        }

        public async Task<List<Asignatura>> EditAjax(int id)
        {
            List<Asignatura> asignaturas = new List<Asignatura>();
            var asignatura = await _context.Asignatura.SingleOrDefaultAsync(m => m.Id == id);
            asignaturas.Add(asignatura);
            return asignaturas;
        }

        public async Task<String> EditAsignaturaAjax(int id, string nombre, int horassemanales, int refcurso)
        {
            Asignatura asignatura = new Asignatura(id, nombre, horassemanales, refcurso);
            _context.Update(asignatura);
            await _context.SaveChangesAsync();
            return "Save";
        }

        public async Task<String> EliminarAsignatura(int id)
        {
            var asignatura = await _context.Asignatura.FindAsync(id);
            _context.Asignatura.Remove(asignatura);
            await _context.SaveChangesAsync();
            return "Delete";
        }
    }
}